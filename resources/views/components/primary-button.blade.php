<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-4']) }}>
    <span>{{ $slot }}</span>
</button>

<style>
    .btn-4 {
        cursor: pointer;
        background-color: transparent;
        width: 70px;
        padding: 8.5px 0;
        border: solid 5px #E2E9C0;
        border-radius: 20px;
        position: relative;
        font-size: 9.5px;
        overflow: hidden;
        transition: 0.1s linear 0.1s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 400;
        color: #161616ff;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .btn-4 span {
        color: #161616ff;
        font-weight: 400;
        position: relative;
        z-index: 2;
        transition: 0.2s linear 0.1s;
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
        transition: 0.2s linear 0.1s;
        z-index: 1;
    }

    .btn-4:hover::after {
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .btn-4:hover span {
        color: #161616ff;
    }
</style>