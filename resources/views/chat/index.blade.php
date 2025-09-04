@extends('layouts.app', [
    'elementActive' => 'chats',
])
@section('css')
    <style>
        .chat-list {
            max-height: 500px;
            overflow-y: auto;
        }

        .chat-item {
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
        }

        .chat-item:hover {
            background-color: #f5f5f5;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chat-details {
            flex: 1;
        }

        .chat-title {
            display: flex;
            align-items: center;
            padding: 10px;
        }

        .chat-message {
            display: flex;
            margin-bottom: 10px;
        }

        .message-avatar {
            margin-right: 10px;
        }

        .message-content {
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 10px;
        }

        .sender .message-content {
            background-color: #dcf8c6;
        }

        .card-footer {
            padding: 10px;
        }

        .chat-window {
            max-height: 500px;
            overflow-y: auto;
        }

        .chat-message-container {
            min-height: 400px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #ffffff;
            margin-bottom: 10px;
        }

        .no-message-conversation {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chat-message.sender {
            margin-bottom: 10px;
            text-align: left;
        }

        .chat-message.receiver {
            margin-bottom: 10px;
            text-align: right;
        }

        .list-group-item.active {
            z-index: 2;
            color: #fff;
            background-color: #4B49AC;
            border-color: #4B49AC;
        }

        .chat-message {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }

        .chat-message .message-avatar img {
            width: 40px;
            height: 40px;
        }

        .chat-message .message-content {
            display: inline-block;
            padding: 10px;
            border-radius: 5px;
            background-color: #f1f1f1;
            margin: 0 10px;
            max-width: 70%;
        }

        .chat-message.sender .message-content {
            background-color: #d1e7dd;
            /* Example color for sender */
            text-align: right;
            margin-left: auto;
            /* Align right */
        }

        .chat-message.sender {
            flex-direction: row-reverse;
        }

        .chat-message .timestamp {
            font-size: 0.8em;
            color: #888;
        }

        .chat-message.sender .timestamp {
            margin-right: 10px;
        }

        .profile_card {
            display: flex;
            align-items: center;
            padding: 15px;
            margin: 10px 0;
            background-color: #f8f9fa;
            /* Light background color */
            border-radius: 10px;
            /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
            transition: transform 0.2s;
            /* Animation for hover effect */
        }

        .profile_card:hover {
            transform: translateY(-5px);
            /* Lift the card on hover */
        }

        .profile_img {
            width: 60px;
            /* Avatar size */
            height: 60px;
            margin-right: 15px;
            border: 2px solid #007bff;
            /* Border color matching badge */
        }

        .chat-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .profile_name {
            font-size: 1.1em;
            /* Slightly larger font size */
            font-weight: bold;
            color: #343a40;
            /* Darker text color */
            margin-bottom: 5px;
        }

        .badge-primary {
            background-color: #007bff;
            /* Badge background color */
            color: #fff;
            /* Badge text color */
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
            align-self: flex-start;
            /* Align the badge to the start */
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">


                    <br>
                    <div class="col-md-12 mt-4 grid-margin">
                        <div class="row">
                            <!-- Left column: Chat list -->
                            <div class="col-md-4 col-lg-3 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="mb-0">Chats</h4>
                                    </div>
                                    <div class="list-group chat-list" id="chatList"
                                        style="max-height: 500px; overflow-y: auto;">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($users as $user)
                                                <li class="list-group-item d-flex align-items-center chat-item">
                                                    <img src="{{ $user->picture ? asset('storage/' . $user->picture) : asset('src/assets/images/default-user-image.svg') }}"
                                                        class="profile_img rounded-circle mr-3"
                                                        style="width: 40px; height: 40px;" alt="Profile Picture">
                                                    <div class="profile_info">
                                                        <span
                                                            class="profile_name font-weight-bold">{{ $user->name }}</span>
                                                        <span class="id"
                                                            style="display: none;">{{ $user->id }}</span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Right column: Chat area -->
                            <div class="col-md-8 col-lg-9 chat-area d-none">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <div class="d-flex align-items-center">
                                            {{-- <img id="chat_img" src="" class="rounded-circle mr-3"
                                                alt="Profile Picture" style="width: 40px; height: 40px;"> --}}
                                            <h4 class="mb-0" id="chat_name"></h4>
                                        </div>
                                    </div>

                                    <div class="card-body chat-window" style="height: 400px; overflow-y: auto;">
                                        <div class="chat-message-container" id="chatMessageContainer">
                                            <!-- Chat messages will be dynamically loaded here -->
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <form id="messageForm" method="POST">
                                            @csrf
                                            <input type="hidden" name="receiver_id" id="receiver_id">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    placeholder="Type your message here..." id="messageInput"
                                                    name="message">
                                                <button class="btn btn-primary" type="submit"
                                                    id="sendMessageButton">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">

            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
@endsection


@push('js')
    <!-- container-scroller -->
    <script>
        // Initialize Pusher
        var loggedUserInfo = @json(auth()->user());
        var receiverId = loggedUserInfo.id; // The receiverId will be the logged user's ID
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });


        // Subscribe to the public channel based on the receiverId
        var channel = pusher.subscribe('my-channel-test.' + receiverId); // Use dynamic receiverId

        // Bind to the 'message' event
        channel.bind('my-event-test', function(data) {
            let senderId = data.sender_id;
            let message = data.message;
            let senderName = data.sender_name;
            let senderImage = `{{ asset('src/assets/images/default-user-image.svg') }}`;
            // let senderImage = data.sender_image ?
            //     `{{ asset('storage/') }}/${data.sender_image}` :
            //     `{{ asset('src/assets/images/default-user-image.svg') }}`; // Default image

            let messageTime = data.time;


            // Check if the logged-in user is the receiver before displaying the message
            if (data.receiver_id == receiverId) {
                let noMessages = document.getElementById('no-messages');
                if (noMessages) {
                    // noMessages.style.display = 'none';
                    noMessages.remove(); // removes the <p> from DOM
                }

                $('.chat-message-container').removeClass('no-message-conversation');


                let messageHtml = `
                    <div class="chat-message receiver">
                        <div class="message-avatar">
                            <img src="${senderImage}" class="rounded-circle avatar" alt="${senderName} Avatar">
                        </div>
                        <div class="message-content">
                            <p class="text-start"><strong>${senderName}:</strong> ${message}</p>
                            <div class="timestamp">${messageTime}</div>
                        </div>
                    </div>`;

                // Append message to chat container
                document.getElementById('chatMessageContainer').insertAdjacentHTML('beforeend', messageHtml);

                // document.getElementById('chatMessageContainer').append(messageHtml);

                // Scroll to the bottom of the chat container
                $('#chatMessageContainer').scrollTop($('#chatMessageContainer')[0].scrollHeight);
            }
        });
    </script>


    <script>
        $('.chat-item').on('click', function() {
            $('.chat-area').removeClass('d-none');


            let otherUserId = $(this).find('.id').text(); // the user you are chatting with
            $.ajax({
                url: '{{ route("chat.opened") }}',
                method: 'POST',
                data: {
                    other_user_id: otherUserId, // conversation partner
                    _token: '{{ csrf_token() }}'
                }
            });


            let profileImage = $(this).find('.profile_img').attr('src');
            let profileName = $(this).find('.profile_name').text();
            let receiverId = $(this).find('.id').text();

            $('#receiver_id').val(receiverId);
            $('#chat_img').attr('src', profileImage);
            $('#chat_name').text(profileName);

            $.ajax({
                url: '{{ route('fetch.messages') }}',
                method: 'GET',
                data: {
                    receiver_id: receiverId
                },
                success: function(response) {
                    $('#chatMessageContainer').empty();
                    $('.chat-message-container').removeClass('no-message-conversation');

                    if (response.messages.length != 0) {
                        let unreadIds = [];

                        response.messages.forEach(function(message) {
                            let isSender = message.sender_id == loggedUserInfo.id;
                            let isReceiver = message.receiver_id == loggedUserInfo.id;

                            let userAvatar =
                                '{{ asset('src/assets/images/default-user-image.svg') }}';
                            let userName = isSender ? '{{ auth()->user()->name }}' :
                                profileName;

                            let messageTime = new Date(message.created_at).toLocaleTimeString(
                            [], {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                });

                            let messageHtml = `
                        <div class="chat-message ${isSender ? 'sender' : 'receiver'}">
                            <div class="message-avatar">
                                <img src="${userAvatar}" class="rounded-circle avatar" alt="User Avatar">
                            </div>
                            <div class="message-content">
                                <p class="text-start"><strong>${userName}:</strong> ${message.message}</p>
                                <div class="timestamp">${messageTime}</div>
                            </div>
                        </div>`;

                            document.getElementById('chatMessageContainer').insertAdjacentHTML(
                                'beforeend', messageHtml);

                            // Mark as read only if this message was sent to the logged-in user
                            if (!isSender && isReceiver) {
                                unreadIds.push(message.id);
                            }
                        });

                        $('#chatMessageContainer').scrollTop($('#chatMessageContainer')[0]
                        .scrollHeight);

                        // Send AJAX to mark messages as read
                        if (unreadIds.length > 0) {
                            $.ajax({
                                url: '{{ route('chats.mark-as-read') }}',
                                method: 'POST',
                                data: {
                                    chat_ids: unreadIds,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(res) {
                                    console.log('Messages marked as read');
                                },
                                error: function(err) {
                                    console.error('Error marking messages as read:', err);
                                }
                            });
                        }

                    } else {
                        $('.chat-message-container').addClass('no-message-conversation');
                        let messageHtml =
                            `<p class="text-bold fs-3" id="no-messages">There is no message</p>`;
                        document.getElementById('chatMessageContainer').insertAdjacentHTML('beforeend',
                            messageHtml);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching messages:', error);
                }
            });
        });
    </script>


    <script>
        $('#messageForm').on('submit', function(e) {
            e.preventDefault();

            let message = $('#messageInput').val().trim();
            let receiverId = $('#receiver_id').val();

            if (message === "") {
                alert("Message cannot be empty.");
                return;
            }

            // Set CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ route('send.message') }}', // Ensure route is correct
                data: {
                    message: message,
                    receiver_id: receiverId
                },
                beforeSend: function() {
                    // Disable the send button and change its text to "Sending..."
                    $('#sendMessageButton').text('Sending...').attr('disabled', true);
                },
                success: function(response) {
                    // console.log(response);
                    let noMessages = document.getElementById('no-messages');
                    if (noMessages) {
                        // noMessages.style.display = 'none';
                        noMessages.remove(); // removes the <p> from DOM
                    }
                    // $('#no-messages').css('display', 'none');
                    $('.chat-message-container').removeClass('no-message-conversation');
                    if (response.success) {
                        // toastr.success(response.message, "Success");
                        $('#messageInput').val(''); // Clear the input
                        // let userAvatar = '{{ auth()->user()->picture ? asset('storage/' . auth()->user()->picture) : asset('src/assets/images/default-user-image.svg') }}';
                        let userAvatar = '{{ asset('src/assets/images/default-user-image.svg') }}';
                        // let userAvatar = '{{ asset('src/assets/images/default-user-image.svg') }}';
                        let userName = '{{ auth()->user()->name }}';

                        let messageTime = new Date().toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                        let messageHtml = `
                            <div class="chat-message sender">
                                <div class="message-avatar">
                                    <img src="${userAvatar}" class="rounded-circle avatar" alt="User Avatar">
                                </div>
                                <div class="message-content">
                                    <p class="text-start"><strong>${userName}:</strong> ${message}</p>
                                    <div class="timestamp">${messageTime}</div>
                                </div>
                            </div>`;
                        // console.log(messageHtml);

                        document.getElementById('chatMessageContainer').insertAdjacentHTML('beforeend',
                            messageHtml);

                        // Scroll to the bottom of the chat container after sending a message
                        $('#chatMessageContainer').scrollTop($('#chatMessageContainer')[0]
                            .scrollHeight);
                    } else {
                        toastr.error(response.message, "Error");
                    }
                },
                error: function(xhr) {
                    // console.error('Error:', xhr.responseJSON.message);
                    toastr.error('Failed to send message', "Error");
                },
                complete: function() {
                    // Re-enable the send button and change its text back to "Send"
                    $('#sendMessageButton').text('Send').attr('disabled', false);
                }
            });
        });
    </script>
@endpush
