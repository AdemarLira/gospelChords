<?php

require_once __DIR__ . '/../services/DashboardService.php';

class DashboardController
{
    private DashboardService $service;

    public function __construct(mysqli $conn)
    {
        $this->service = new DashboardService($conn);
    }

    public function index(): array
    {
        return $this->service->obterResumo();
    }
}