<?php

namespace Tests\Unit;

use App\View\Components\AppLayout;
use Tests\TestCase;

class AppLayoutComponentTest extends TestCase
{
    public function test_render_returns_app_layout_view(): void
    {
        $component = new AppLayout();

        $view = $component->render();

        $this->assertSame('layouts.app', $view->name());
    }
}
