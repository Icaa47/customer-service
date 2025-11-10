<?php

namespace Tests\Unit;

use App\Livewire\AkunCs\Index as AkunCsIndex;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use ReflectionProperty;

class AkunCsIndexTest extends TestCase
{
    public function test_generate_chart_values_uses_history_data(): void
    {
        $component = new AkunCsIndex();

        $method = new ReflectionMethod(AkunCsIndex::class, 'generateChartValues');
        $method->setAccessible(true);

        $baseDate = Carbon::create(2024, 1, 10, 9);
        $period = collect(range(6, 0))->map(
            fn (int $day) => $baseDate->copy()->subDays($day)->startOfDay()
        );

        $history = collect([
            (object) ['closing_date' => '2024-01-09', 'closing_total' => 3],
            (object) ['closing_date' => '2024-01-08', 'closing_total' => 1],
        ]);

        $values = $method->invoke($component, $period, $history);

        $expected = $period->map(function (Carbon $date) {
            if ($date->isSameDay(Carbon::create(2024, 1, 8))) {
                return 1;
            }

            if ($date->isSameDay(Carbon::create(2024, 1, 9))) {
                return 3;
            }

            return 0;
        })->toArray();

        $this->assertSame($expected, $values);
    }

    public function test_build_chart_meta_produces_consistent_structure(): void
    {
        $component = new AkunCsIndex();

        $labelsProperty = new ReflectionProperty(AkunCsIndex::class, 'chartLabels');
        $labelsProperty->setAccessible(true);
        $labelsProperty->setValue($component, ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']);

        $method = new ReflectionMethod(AkunCsIndex::class, 'buildChartMeta');
        $method->setAccessible(true);

        $values = array_fill(0, 7, 12);

        $meta = $method->invoke($component, $values);

        $this->assertSame($values, $meta['values']);
        $this->assertCount(7, $meta['labels']);
        $this->assertCount(7, $meta['points']);
        $this->assertSame(13, $meta['max']);
        $this->assertSame(11, $meta['min']);
        $this->assertSame(12.0, $meta['average']);

        foreach ($meta['points'] as $point) {
            $this->assertArrayHasKey('x', $point);
            $this->assertArrayHasKey('y', $point);
            $this->assertArrayHasKey('value', $point);
            $this->assertSame(12, $point['value']);
        }

        $this->assertStringStartsWith('M ', $meta['path']);
        $this->assertStringEndsWith(' Z', $meta['area']);
    }
}
