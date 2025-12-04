<style>
    .file-input-wrapper {
        position: relative;
        margin-bottom: 1rem;
    }
    .file-input-custom {
        border: 2px dashed #ddd;
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        background: #fafafa;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .file-input-custom:hover {
        border-color: #002960;
        background: #f8f9fa;
    }
    .file-input-custom.dragover {
        border-color: #002960;
        background: #e3f2fd;
        transform: scale(1.02);
    }
    .file-input-icon {
        font-size: 3rem;
        color: #6c757d;
        margin-bottom: 1rem;
        display: block;
    }
    .file-input-text {
        font-size: 1.1rem;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    .file-input-hint {
        font-size: 0.9rem;
        color: #6c757d;
    }
    .file-input-btn {
        background: #002960;
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 1rem;
        transition: background 0.3s ease;
    }
    .file-input-btn:hover {
        background: #0056b3;
    }
    .file-input-real {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .file-preview {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    .file-preview-item {
        position: relative;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 15px;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .file-preview-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .file-preview-thumbnail {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    .file-preview-icon {
        font-size: 3rem;
        text-align: center;
        color: #6c757d;
        margin-bottom: 10px;
    }
    .file-preview-name {
        font-size: 0.8rem;
        word-break: break-word;
        text-align: center;
        color: #495057;
        line-height: 1.3;
    }
    .file-preview-size {
        font-size: 0.7rem;
        color: #6c757d;
        text-align: center;
        margin-top: 5px;
    }
    .file-remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ff4757;
        color: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }
    .file-remove-btn:hover {
        background: #ff3742;
        transform: scale(1.1);
    }
    .file-count-badge {
        position: absolute;
        top: -10px;
        right: -10px;
        background: #28a745;
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    .file-progress {
        width: 100%;
        height: 4px;
        background: #e9ecef;
        border-radius: 2px;
        margin-top: 10px;
        overflow: hidden;
    }
    .file-progress-bar {
        height: 100%;
        background: #002960;
        width: 0%;
        transition: width 0.3s ease;
    }
    .has-error .file-input-custom {
        border-color: #dc3545;
        background: #f8d7da;
    }
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }
    .file-loading {
        animation: pulse 1.5s ease-in-out infinite;
    }
    .file-category-name{
        font-size: 1.5rem;
    }
    @media (max-width: 768px) {
        .file-preview {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
        }
        .file-input-custom {
            padding: 1.5rem;
        }
        .file-input-icon {
            font-size: 2.5rem;
        }
    }
</style>