<style>
    #pointer-dot {
        left: -4px;
        top: -4px;
        width: 12px;
        height: 12px;
        position: fixed;
        border-radius: 10px;
        z-index: 999998;
        pointer-events: none;
        transition: border-color 0.5s;
        background: #333;
        box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.2); 
    }
    #pointer-ring {
        left: 0;
        top: 0;
        width: 25px;
        height: 25px;
        display: block;
        border: 1px solid #002960 !important;
        position: fixed;
        border-radius: 100px;
        z-index: 999999;
        pointer-events: none;
        transition: width 0.3s, height 0.3s; 
    }
    #pointer-ring.active {
        width: 50px;
        height: 50px;
        opacity: 0.5; 
    }
    #pointer-ring.active + #pointer-dot {
        opacity: 0; 
    }
</style>