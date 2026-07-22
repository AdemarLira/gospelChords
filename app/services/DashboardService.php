<?php

require_once __DIR__ . '/../models/Dashboard.php';

class DashboardService
{
    private Dashboard $dashboard;

    public function __construct(mysqli $conn)
    {
        $this->dashboard = new Dashboard($conn);
    }

    public function obterResumo(): array
    {
        return [
            'totalAlunos' => $this->dashboard->totalAlunos(),

            'totalAssinantes' => $this->dashboard->totalAssinantes(),

            'totalCursos' => $this->dashboard->totalCursos(),

            'totalCifras' => $this->dashboard->totalCifras(),

            'totalTablaturas' => $this->dashboard->totalTablaturas(),

            'totalPartituras' => $this->dashboard->totalPartituras(),

            'totalAtivos' => $this->dashboard->totalAtivos(),

            'totalPendentes' => $this->dashboard->totalPendentes()
        ];
    }
}