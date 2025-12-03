@extends('layout')

@section('page_title', 'Tableau de bord - Administration')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('build/assets/app-CxrrfATK.css') }}">

<style>
    :root {
        --primary-color: #E2E9C0;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --info-color: #3b82f6;
        --dark-color: #1f2937;
        --light-color: #f9fafb;
    }

    .dashboard-container {
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .dashboard-header {
        margin-bottom: 2.5rem;
        text-align: center;
    }

    .dashboard-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .dashboard-subtitle {
        font-size: 1.125rem;
        color: #6b7280;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .stat-card.bg-primary { background-color: var(--primary-color); }
    .stat-card.bg-success { background-color: var(--success-color); }
    .stat-card.bg-warning { background-color: var(--warning-color); }
    .stat-card.bg-info { background-color: var(--info-color); }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        opacity: 0.9;
    }

    .stat-trend {
        display: inline-flex;
        align-items: center;
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        margin-top: 0.5rem;
    }

    .trend-up {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .stat-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: white;
        opacity: 0.9;
    }
</style>
@endpush

@section('page_content')
<div class="dashboard-container">
    <div class="container-fluid">
        <!-- En-tête du tableau de bord -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Tableau de bord Administrateur</h1>
            <p class="dashboard-subtitle">Vue d'ensemble des performances et statistiques</p>
        </div>

        <!-- Cartes de statistiques principales -->
        <div class="stats-grid">
            @foreach($stats as $key => $stat)
            <div class="stat-card {{ $stat['class'] }}">
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
        </div>
    </div>
</div>
@endsection
