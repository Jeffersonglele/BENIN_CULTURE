<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-4']) }}>
    <span>{{ $slot }}</span>
</button>

<style>
    .btn-4 {
        cursor: pointer;
        background-color: #000000;
        width: 70px;
        padding: 8.5px 0;
        border: solid 2px #000000;
        border-radius: 20px;
        position: relative;
        font-size: 9.5px;
        overflow: hidden;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 400;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .btn-4 span {
        color: #ffffff;
        font-weight: 400;
        position: relative;
        z-index: 2;
        transition: all 0.3s ease;
    }

    .btn-4::after {
        display: block;
        content: "";
        background-color: #c57e0bff;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        transition: all 0.4s ease;
        z-index: 1;
    }

    .btn-4:hover::after {
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .btn-4:hover span {
        color: #ffffff;
    }

    /* Support pour le thème sombre */
    @media (prefers-color-scheme: dark) {
        .btn-4 {
            background-color: #1a1a1a;
            border-color: #1a1a1a;
        }
        
        .btn-4:hover {
            border-color: #c57e0bff;
        }
    }

    /* Version avec classes dark de Tailwind */
    .dark .btn-4 {
        background-color: #1a1a1a;
        border-color: #1a1a1a;
    }
    
    .dark .btn-4:hover {
        border-color: #c57e0bff;
    }
</style>