$controller = new App\Http\Controllers\Admin\DashboardController();
try {
    $view = $controller->index();
    $html = $view->render();
    echo "RENDER_OK length=" . strlen($html) . "`n";
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "`n" . $e->getFile() . ":" . $e->getLine() . "`n";
}
