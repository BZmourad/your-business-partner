<style>
    #loading-area {
        position: fixed;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        z-index: 999999999;
        background-position: center;
        background-repeat: no-repeat;
        background-size: 80px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #loading-area .loader {
        width: 100px;
        height: 100px;
        margin: 40px auto 0;
        position: relative;
        animation: animate 1s infinite;
    }
    #loading-area .loader .ball {
        width: 40%;
        height: 40%;
        border-radius: 50%;
        position: absolute;
        animation: speed 2s infinite ease-in-out;
    }
    #loading-area .loader .one {
        background: #002960;
        animation-delay: 1.5s;
    }
    #loading-area .loader .two {
        background: #002960;
        animation-delay: 1s;
    }
    #loading-area .loader .three {
        background: #002960;
        animation-delay: 0.5s;
    }
    #loading-area .loader .four {
        background: #002960;
    }
    @keyframes speed {
        0% {
            border-radius: 50%;
            transform: translate(0%);
        }
        25% {
            border-radius: 0;
            transform: translate(150%) scale(0.5);
        }
        50% {
            border-radius: 50%;
            transform: translate(150%, 150%);
        }
        75% {
            border-radius: 0;
            transform: translate(0, 150%) scale(0.5);
        }
    }
</style>