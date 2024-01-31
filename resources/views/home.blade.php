@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Display User List -->
                    <h2>User List</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Follower</th>
                                <th>Subscribe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through users -->
                            @foreach($users as $user)
                            <tr>
                                <!-- User details -->
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>

                                <!-- Follower count -->
                                <td id="follower-count-{{ $user->id }}">{{ $user->follower }}</td>

                                <!-- Subscribe button -->
                                <td>
                                    <button class="subscribe-btn btn btn-primary"
                                            data-user="{{ $user->id }}"
                                            data-subscribed="{{ auth()->user()->isSubscribed($user) ? 'true' : 'false' }}">
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        <span class="subscribe-text">
                                            {{ auth()->user()->isSubscribed($user) ? 'Unsubscribe' : 'Subscribe' }}
                                        </span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Axios library -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.subscribe-btn');

            buttons.forEach(button => {
                button.addEventListener('click', async function () {
                    const userId = this.dataset.user;
                    const subscribed = this.dataset.subscribed === 'true';

                    const routeName = subscribed ? 'subscribe.unsubscribe' : 'subscribe.subscribe';

                    // Show the spinner
                    const spinner = this.querySelector('.spinner-border');
                    const subscribeText = this.querySelector('.subscribe-text');
                    spinner.classList.remove('d-none');
                    subscribeText.textContent = '';

                    try {
                        const response = await axios[subscribed ? 'delete' : 'post'](`/subscribe/${userId}`, null, {
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                        });

                        const data = response.data;

                        this.dataset.subscribed = subscribed ? 'false' : 'true';

                        // Update button text based on subscription status
                        subscribeText.textContent = subscribed ? 'Subscribe' : 'Unsubscribe';

                        const followerCountElement = document.getElementById(`follower-count-${userId}`);
                        if (followerCountElement) {
                            followerCountElement.textContent = data.followerCount;
                        }

                        // Add Toastr notification
                        const notificationMessage = subscribed ? 'Unsubscribed successfully!' : 'Subscribed successfully!';
                        toastr.success(notificationMessage);
                    } catch (error) {
                        console.error('Error:', error);

                        // Revert the button text on error
                        subscribeText.textContent = subscribed ? 'Unsubscribe' : 'Subscribe';

                        // Add Toastr notification for error
                        toastr.error('An error occurred. Please try again.');

                        // Retry after 5 seconds

                    } finally {
                        // Hide the spinner
                        spinner.classList.add('d-none');
                    }
                });
            });
        });
    </script>
</div>
@endsection
