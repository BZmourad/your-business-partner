<script>
    let receiver_id = null;
    let user_id = "{{ auth()->user()->id }}"; // ID de l'utilisateur connecté
    let lastMessageId = 0; // Dernier message reçu
    let fetchInterval = setInterval(fetchNewMessages, 30000);

    let lang_user_2 = "{{ auth()->user()->lang }}";
    if ( lang_user_2 == "fr" ) {
        lang_user_2 = "fr-FR";
    } else {
        lang_user_2 = "en-US";
    }

    $(document).ready(function() {

        $('.user-item').on('click', function() {
            $("body").LoadingOverlay("show");
            receiver_id = $(this).data('id');
            $('#receiver_id').val(receiver_id);
            

            let userName = $(this).find('.user-item-name').text().trim();
            let userAvatar = $(this).find('img').attr('src');

            $('#chat-user-name').text(userName);
            $('#chat-user-avatar').attr('src', userAvatar).show();
            // Marquer les messages comme lus
            $.post('/admin/messages/mark-as-read', { receiver_id: receiver_id, _token: '{{ csrf_token() }}' }, function(response) {
                if (response.et != 0) {
                    toastr.success("Messages marqués comme lus !");
                }
                
                // Supprime l'affichage du nombre de messages non lus
                $(`.user-item[data-id="${receiver_id}"]`).find('.badge').remove();
                $("body").LoadingOverlay("hide", true);
            });

            loadMessages(receiver_id);
        });

        $('#attach-btn').click(function() {
            $('#attachment').click();
        });

        $('#message-form').on('submit', function(e) {
            e.preventDefault();
            sendMessage();
        });

        
    });

    function loadMessages(receiver_id) {
        $("body").LoadingOverlay("show");
        $.get('/admin/messages/' + receiver_id, function(messages) {
            $('#messages-list').html('');
            messages.forEach(msg => {
                displayMessage(msg, msg.sender_id == user_id ? 'sent' : 'received');
                lastMessageId = msg.id;
            });
            $("body").LoadingOverlay("hide", true);
        });
    }

    function fetchNewMessages() {
        if (receiver_id) {
            $.get(`/admin/messages/${receiver_id}/latest/${lastMessageId}`, function(messages) {
                messages.forEach(msg => {
                    displayMessage(msg, msg.sender_id == user_id ? 'sent' : 'received');
                    lastMessageId = msg.id;
                });
            });
        }
    }

    function sendMessage() {
        // Désactiver temporairement fetchNewMessages()
        clearInterval(fetchInterval);
        $("body").LoadingOverlay("show");
        let formData = new FormData();
        formData.append('receiver_id', receiver_id);
        formData.append('message', $('#message').val()); 
        let file = $('#attachment')[0].files[0];
        if (file) formData.append('attachment', file);

        $.ajax({
            url: '/admin/messages',
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                lastMessageId = response.data.id;
                displayMessage(response.data, 'sent');
                $('#message').val(''); // Réinitialise le champ après l'envoi
                $('#attachment').val('');
                toastr.success(response.message);
                $("body").LoadingOverlay("hide", true);
                // Réactiver fetchNewMessages() après un court délai
                setTimeout(() => {
                    fetchInterval = setInterval(fetchNewMessages, 3000);
                }, 2000);
            },
            error: function(xhr) {
                let errorMessage = xhr.responseJSON?.error || "{{ __('An error has occurred. Please try again.')}}";
                toastr.error(errorMessage);
                $("body").LoadingOverlay("hide", true);
            }
        });
    }

    function formatDate(timestamp) {
        let date = new Date(timestamp);
        return date.toLocaleDateString(lang_user_2, { 
            weekday: 'short', 
            day: '2-digit', 
            month: 'long', 
            year: 'numeric', 
            hour: '2-digit', 
            minute: '2-digit' 
        });
    }

    function displayMessage(message, type) {
        if ($(`#msg-${message.id}`).length > 0) {
            return; // Éviter les doublons
        }
        let formattedDate = formatDate(message.created_at);

        let msgHtml = `<div class="chat message ${type === 'sent' ? '' : 'chat-left'}" id="msg-${message.id}">`;
            if (type != 'sent') {
                msgHtml += `<div class="chat-avatar">
                    <a class="avatar m-0">
                        <img src="{{ asset('storage/users/${message.sender.avatar}') }}" alt="avatar" height="36" width="36" />
                    </a>
                </div>`;
            }
        
        msgHtml += `<div class="chat-body">
                <div class="chat-message">
                    ${message.message ? '<p>'+message.message+'</p>' : ''}
                    ${message.attachment ? `<p><a href="/admin/messages/${message.id}/download" target="_blank"> <i class="fas fa-paperclip"></i> Télécharger</a><br></p>` : ''}
                    <span class="chat-time">${formattedDate}</span>
                </div>
            </div>
        </div>`;

        $('#messages-list').append(msgHtml);
        $(".chat-container").scrollTop($(".chat-container > .chat-content").height());
    }
</script>
<script>
    $(document).ready(function () {

        // Toggle the visibility when clicking on the corresponding heading
        $("#bloc-01").click(function () {
            $(".bloc-01").toggle();  // Show/hide .bloc-01
            $(this).find('i').toggleClass('ft-plus ft-minus');  // Change the icon
        });

        $("#bloc-02").click(function () {
            $(".bloc-02").toggle();  // Show/hide .bloc-02
            $(this).find('i').toggleClass('ft-plus ft-minus');  // Change the icon
        });

        $("#bloc-03").click(function () {
            $(".bloc-03").toggle();  // Show/hide .bloc-03
            $(this).find('i').toggleClass('ft-plus ft-minus');  // Change the icon
        });
    });
</script>