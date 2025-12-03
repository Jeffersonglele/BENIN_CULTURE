@extends('layout')

@section('page_title', 'Tableau de bord - Administration')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
        --primary-color: #E2E9C0;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --info-color: #3b82f6;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --bg-light: #f8fafc;
        --border-light: #e5e7eb;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .dashboard-container {
        background: var(--bg-light);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .dashboard-header {
        margin-bottom: 2.5rem;
    }

    .dashboard-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        letter-spacing: -0.025em;
    }

    .dashboard-subtitle {
        color: var(--text-secondary);
        font-size: 1rem;
        font-weight: 400;
    }

    /* Cartes de statistiques améliorées */
    .stat-card {
        background: white;
        border-radius: 12px;
        border: 1px solid var(--border-light);
        box-shadow: var(--shadow-sm);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        position: relative;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        border-color: #d1d5db;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--primary-color);
    }

    .stat-card.success::before {
        background: var(--primary-color);
    }

    .stat-card.warning::before {
        background: var(--warning-color);
    }

    .stat-card.info::before {
        background: var(--info-color);
    }

    .stat-card .card-body {
        padding: 1.75rem;
    }

    .stat-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .stat-main {
        flex: 1;
    }

    .stat-value {
        font-size: 2.25rem;
        font-weight: 800;
        color: var(--text-primary);
        line-height: 1;
        margin-bottom: 0.25rem;
        letter-spacing: -0.025em;
    }

    .stat-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        background: var(--primary-color);
    }

    .stat-card.success .stat-icon {
        background: var(--success-color);
    }

    .stat-card.warning .stat-icon {
        background: var(--warning-color);
    }

    .stat-card.info .stat-icon {
        background: var(--info-color);
    }

    .stat-trend {
        display: inline-flex;
        align-items: center;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        margin-top: 0.5rem;
    }

    .trend-up {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success-color);
    }

    .trend-down {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    /* Graphiques améliorés */
    .chart-container {
        background: white;
        border-radius: 12px;
        border: 1px solid var(--border-light);
        box-shadow: var(--shadow-sm);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        height: 100%;
        transition: box-shadow 0.3s ease;
    }

    .chart-container:hover {
        box-shadow: var(--shadow-md);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-light);
    }

    .chart-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
    }

    .chart-actions {
        display: flex;
        gap: 0.5rem;
    }

    .chart-action-btn {
        background: none;
        border: 1px solid var(--border-light);
        border-radius: 6px;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .chart-action-btn:hover {
        background: var(--bg-light);
        color: var(--text-primary);
    }

    .chart-wrapper {
        position: relative;
        height: 300px;
        width: 100%;
    }

    /* Grid responsive */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem 0;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .chart-wrapper {
            height: 250px;
        }

        .stat-value {
            font-size: 2rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.25rem;
        }
    }

    @media (max-width: 480px) {
        .dashboard-title {
            font-size: 1.5rem;
        }

        .stat-card .card-body {
            padding: 1.25rem;
        }

        .stat-value {
            font-size: 1.75rem;
        }
    }

    /* Animation subtile */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card, .chart-container {
        animation: fadeInUp 0.6s ease-out;
    }
</style>
@endpush

@section('page_content')
<div class="dashboard-container">
    <div class="container-fluid">
        <!-- En-tête du tableau de bord -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Tableau de bord</h1>
            <p class="dashboard-subtitle">Vue d'ensemble des performances et statistiques</p>
        </div>

        <!-- Cartes de statistiques principales -->
        <div class="stats-grid">
            @foreach($stats as $key => $stat)
            <div class="stat-card {{ $stat['class'] ?? '' }}">
                <div class="card-body">
                    <div class="stat-content">
                        <div class="stat-main">
                            <div class="stat-value">{{ number_format($stat['total']) }}</div>
                            <div class="stat-label">{{ ucfirst($key) }}</div>
                            @if(isset($stat['nouveaux_mois']))
                            <div class="stat-trend trend-up">
                                <i class="fas fa-arrow-up me-1"></i>
                                {{ $stat['nouveaux_mois'] }} ce mois
                            </div>
                            @endif
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-{{ $stat['icon'] }}"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Carte contenus publiés -->
            <div class="stat-card success">
                <div class="card-body">
                    <div class="stat-content">
                        <div class="stat-main">
                            <div class="stat-value">{{ number_format($contenuStats['total'] ?? 0) }}</div>
                            <div class="stat-label">Contenus publiés</div>
                            <div class="d-flex gap-2 mt-2">
                                <div class="stat-trend trend-up">
                                    <i class="fas fa-check-circle me-1"></i>
                                    {{ $contenuStats['valides'] ?? 0 }} validés
                                </div>
                                <div class="stat-trend trend-up">
                                    <i class="fas fa-arrow-up me-1"></i>
                                    {{ $contenuStats['nouveaux_contenus_mois'] ?? 0 }} ce mois
                                </div>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="row">
            <!-- Graphique des utilisateurs -->
            <div class="col-xl-6 mb-4">
                <div class="chart-container">
                    <div class="chart-header">
                        <h5 class="chart-title">Évolution des utilisateurs</h5>
                        <div class="chart-actions">
                            <button class="chart-action-btn">30j</button>
                            <button class="chart-action-btn">90j</button>
                            <button class="chart-action-btn">1an</button>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="userChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Graphique des contenus -->
            <div class="col-xl-6 mb-4">
                <div class="chart-container">
                    <div class="chart-header">
                        <h5 class="chart-title">Activité des contenus</h5>
                        <div class="chart-actions">
                            <button class="chart-action-btn">30j</button>
                            <button class="chart-action-btn">90j</button>
                            <button class="chart-action-btn">1an</button>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="contentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configuration des couleurs
    const colors = {
        primary: '#2c5aa0',
        success: '#10b981',
        warning: '#f59e0b',
        info: '#3b82f6',
        light: '#f8fafc'
    };

    // Graphique des utilisateurs (Line Chart)
    const userCtx = document.getElementById('userChart');
    if (userCtx) {
        new Chart(userCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Nouveaux utilisateurs',
                    data: {!! json_encode($contenusData) !!},
                    borderColor: colors.primary,
                    backgroundColor: `rgba(44, 90, 160, 0.1)`,
                    borderWidth: 3,
                    pointBackgroundColor: colors.primary,
                    pointBorderColor: '#fff',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: colors.primary,
                        bodyColor: '#1f2937',
                        borderColor: colors.primary,
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6b7280'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            color: '#6b7280',
                            precision: 0
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }

    // Graphique des contenus (Bar Chart)
    const contentCtx = document.getElementById('contentChart');
    if (contentCtx) {
        new Chart(contentCtx, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Contenus publiés',
                    data: @json($contenusData),
                    backgroundColor: `rgba(16, 185, 129, 0.8)`,
                    borderColor: colors.success,
                    borderWidth: 1,
                    borderRadius: 6,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Gestion du redimensionnement
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            window.dispatchEvent(new Event('resize'));
        }, 250);
    });
});
</script>
@endpush