        @extends('layouts.app')

        @section('content')

        <div class="profile-wrapper">
        <div class="profile-container">

            <h3>My Profile</h3>

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

<form id="profile-form" enctype="multipart/form-data">

    {{--avatar--}}
    <div class="profile-avatar-large">

        {{--image tag--}}
        <img
            id="avatarPreview"
            src="{{  asset(session('user_avatar'))}}"
            style="{{ session('user_avatar') ? 'display:block;' : 'display:none;' }}"
        >

        {{--default first letter--}}
        <span
            id="avatarLetter"
            style="{{ session('user_avatar') ? 'display:none;' : 'display:flex;' }}"
        >
            {{ strtoupper(substr(session('user_name'),0,1)) }}
        </span>

    </div>

    {{-- File Input --}}
    <input type="file" id="avatarInput" class="avatar-input-btn" accept="image/*">

    {{-- NAME --}}
    <label for="name">Full Name</label>
    <input
        type="text"
        id="name"
        value="{{ trim(($profileData['first_name'] ?? '') . ' ' . ($profileData['last_name'] ?? '')) ?: session('user_name') }}"
    >

    {{-- EMAIL --}}
    <label for="email">Email</label>
    <input
        type="email"
        value="{{ $profileData['email'] ?? session('user_email') }}"
        disabled
    >

    {{-- PHONE --}}
    <label for="phone">Phone</label>
    <input
        type="text"
        id="phone"
        value="{{ $profileData['phone'] ?? session('user_phone') ?? '' }}"
        placeholder="Phone"
    >

    {{-- ADDRESS --}}
    <label for="address">Address</label>
    <textarea id="address" placeholder="Address">{{ $profileData['address'] ?? session('user_address') ?? '' }}</textarea>

    {{-- ROLE --}}
    <label for="role">Role</label>
    <input
        type="text"
        value="{{ session('user_role') }}"
        disabled
    >

    {{-- BUTTON --}}
    <button type="submit" class="updateProfile-btn">
        Update Profile
    </button>

    <a href="{{ route('home') }}" class="back-home-btn">
        Back To Home →
    </a>

</form>

        </div>
        </div>

        @endsection

        @push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    //avatar preview
    document.getElementById('avatarInput').addEventListener('change', function () {

        const file = this.files[0];

        if (file) {
            const preview = document.getElementById('avatarPreview');
            const letter = document.getElementById('avatarLetter');

            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';

            letter.style.display = 'none';
        }
    });


    //profile update
    document.getElementById('profile-form').addEventListener('submit', async function(e){

        e.preventDefault();

        const formData = new FormData();

        formData.append('name', document.getElementById('name').value);
        formData.append('phone', document.getElementById('phone').value);
        formData.append('address', document.getElementById('address').value);

        if (avatarInput.files[0]) {
            formData.append('avatar', avatarInput.files[0]);
        }

        try {

            const response = await fetch("{{ route('profile.update') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: formData
            });

            const result = await response.json();

            console.log(result);

            if (response.ok) {

                alert('Profile Updated Successfully');

                const fullName =
                    ((result.customer.first_name ?? '') + ' ' +
                    (result.customer.last_name ?? '')).trim();

                document.getElementById('name').value = fullName;
                document.getElementById('phone').value = result.customer.phone ?? '';
                document.getElementById('address').value = result.customer.address ?? '';

                if (result.customer.avatar) {

                    document.getElementById('avatarPreview').src =
                        result.customer.avatar;

                    document.getElementById('avatarPreview').style.display = 'block';
                    document.getElementById('avatarLetter').style.display = 'none';
                }

            } else {

                alert(result.message || 'Update Failed');

            }

        } catch (error) {

            console.error(error);
            alert('Something went wrong.');

        }

    });

});
</script>
            
        @endpush