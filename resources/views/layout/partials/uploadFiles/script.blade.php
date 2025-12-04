<script>
    $(document).ready(function() {
        const fileStorages = {};

        function initializeFileStorage(input) {
            const inputId = input.attr('id');
            if (!fileStorages[inputId]) {
                fileStorages[inputId] = new Map();
            }
            return fileStorages[inputId];
        }

        if ($('.file-input-real').length) {
            // Gestion des événements pour tous les inputs file
            $('.file-input-real').each(function() {
                const input = $(this);
                const customArea = input.closest('.file-input-custom');
                
                // Clic sur la zone custom
                customArea.on('click', function(e) {
                    if (!$(e.target).closest('.file-remove-btn').length) {
                        input.trigger('click');
                    }
                });

                // Clic sur le bouton
                customArea.find('.file-input-btn').on('click', function(e) {
                    e.stopPropagation();
                    input.trigger('click');
                });

                // Drag and drop
                customArea.on('dragover', function(e) {
                    e.preventDefault();
                    customArea.addClass('dragover');
                });

                customArea.on('dragleave', function(e) {
                    e.preventDefault();
                    if (!customArea.has(e.relatedTarget).length) {
                        customArea.removeClass('dragover');
                    }
                });

                customArea.on('drop', function(e) {
                    e.preventDefault();
                    customArea.removeClass('dragover');
                    input[0].files = e.originalEvent.dataTransfer.files;
                    input.trigger('change');
                });

                // Changement de fichier
                input.on('change', function() {
                    const isMultiple = input.hasClass('multiple-file-input');
                    const fileStorage = initializeFileStorage(input);
                    const previewContainer = input.closest('.file-input-wrapper').find('.file-preview');
                    
                    if (isMultiple) {
                        const files = Array.from(this.files);
                        files.forEach(file => {
                            const fileId = generateFileId(file);
                            if (!fileStorage.has(fileId)) {
                                fileStorage.set(fileId, file);
                            }
                        });
                        updateFilePreview(input, fileStorage, previewContainer);
                        updateFileInput(input, fileStorage);
                    } else {
                        previewContainer.empty();
                        fileStorage.clear();
                        const file = this.files[0];
                        if (file) {
                            const fileId = generateFileId(file);
                            fileStorage.set(fileId, file);
                            createFilePreview(file, fileId, previewContainer, input, true);
                        }
                    }
                    
                    // Mettre à jour l'apparence de la zone
                    updateCustomAreaAppearance(input, fileStorage);
                });
            });
        }
    
        function generateFileId(file) {
            return `${file.name}-${file.size}-${file.lastModified}`;
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function createFilePreview(file, fileId, container, input, isSingle) {
            if (container.find(`[data-file-id="${fileId}"]`).length > 0) return;

            const previewItem = $('<div class="file-preview-item"></div>');
            previewItem.attr('data-file-id', fileId);
            
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewItem.append(`<img src="${e.target.result}" alt="${file.name}" class="file-preview-thumbnail">`);
                };
                reader.readAsDataURL(file);
            } else {
                const fileIcon = getFileIcon(file.type);
                previewItem.append(`<div class="file-preview-icon">${fileIcon}</div>`);
            }
            
            previewItem.append(`<div class="file-preview-name">${file.name}</div>`);
            previewItem.append(`<div class="file-preview-size">${formatFileSize(file.size)}</div>`);
            
            const removeBtn = $(`<button type="button" class="file-remove-btn" data-file-id="${fileId}">&times;</button>`);
            removeBtn.on('click', function(e) {
                e.stopPropagation();
                removeFilePreview(input, previewItem, fileId, isSingle);
            });
            
            previewItem.append(removeBtn);
            container.append(previewItem);
        }

        function getFileIcon(fileType) {
            if (fileType.includes('pdf')) return '📕';
            if (fileType.includes('word') || fileType.includes('document')) return '📘';
            if (fileType.includes('text')) return '📃';
            if (fileType.includes('image')) return '🖼️';
            return '📎';
        }

        function removeFilePreview(input, previewItem, fileId, isSingle) {
            const inputId = input.attr('id');
            const fileStorage = fileStorages[inputId];
            if (!fileStorage) return;

            previewItem.remove();
            fileStorage.delete(fileId);
            
            if (isSingle) {
                input.val('');
            } else {
                updateFileInput(input, fileStorage);
            }
            
            updateCustomAreaAppearance(input, fileStorage);
        }

        function updateFilePreview(input, fileStorage, previewContainer) {
            previewContainer.empty();
            fileStorage.forEach((file, fileId) => {
                createFilePreview(file, fileId, previewContainer, input, false);
            });
        }

        function updateFileInput(input, fileStorage) {
            const dt = new DataTransfer();
            fileStorage.forEach((file) => {
                dt.items.add(file);
            });
            input[0].files = dt.files;
        }

        function updateCustomAreaAppearance(input, fileStorage) {
            const customArea = input.closest('.file-input-custom');
            const fileCount = fileStorage.size;
            
            if (fileCount > 0) {
                customArea.addClass('has-files');
                // Mettre à jour le texte avec le nombre de fichiers
                const textElement = customArea.find('.select-number-files');
                if (input.hasClass('multiple-file-input')) {
                    textElement.text(`${fileCount} fichier(s) sélectionné(s)`);
                } else {
                    textElement.text('Fichier sélectionné');
                }
            } else {
                customArea.removeClass('has-files');
                const textElement = customArea.find('.select-number-files');
                textElement.text('');
            }
        }

        function highlightError(input) {
            input.closest('.file-input-custom').addClass('has-error');
        }

        function removeErrorHighlight(input) {
            input.closest('.file-input-custom').removeClass('has-error');
        }

        if ($('.file-input-real').length) {
            // Initialiser le stockage
            $('.file-input-real').each(function() {
                initializeFileStorage($(this));
            });
        }
    });
</script>