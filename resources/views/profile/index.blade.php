@extends('layouts.app')
 
@section('content')
 
<div class="profile-wrapper">
 
    {{-- Ambient background orbs --}}
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
 
    <div class="profile-container">
 
        {{-- Decorative side accent --}}
        <div class="side-accent"></div>
 
        {{-- Header --}}
        <div class="profile-header">
            <div class="header-label">ACCOUNT</div>
            <h2>My Profile</h2>
            <p class="header-sub">Manage your personal details & preferences</p>
        </div>
 
        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alert-success">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
        @endif
 
        <form id="profile-form" enctype="multipart/form-data">
 
            {{-- Avatar Section --}}
            <div class="avatar-section">
 
                {{-- {{ dd(session('user_avatar')) }} --}}
                <div class="avatar-ring">
                    <div class="profile-avatar-large">
                        <img
                            id="avatarPreview"
                            src="{{ session('user_avatar') }}"
                            style="{{ session('user_avatar') ? 'display:block;' : 'display:none;' }}"
                            alt="Avatar"
                        >
                        
                        <span
                            id="avatarLetter"
                            style="{{ session('user_avatar') ? 'display:none;' : 'display:flex;' }}"
                        >
                            {{ strtoupper(substr(session('user_name'), 0, 1)) }}
                        </span>
                    </div>
                    <label for="avatarInput" class="avatar-edit-btn" title="Change photo">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </label>
                </div>
 
                <input type="file" id="avatarInput" class="avatar-input-hidden" accept="image/*">
 
                <div class="avatar-info">
                    <span class="avatar-name">{{ session('user_name') }}</span>
                    <span class="avatar-role">{{ ucfirst(session('user_role') ?? 'Customer') }}</span>
                </div>
 
            </div>
 
            {{-- Divider --}}
            <div class="section-divider">
                <span>Personal Information</span>
            </div>
 
            {{-- Fields Grid --}}
            <div class="fields-grid">
 
                {{-- NAME --}}
                <div class="field-group full-width">
                    <label for="name">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Full Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        value="{{ trim(($profileData['first_name'] ?? '') . ' ' . ($profileData['last_name'] ?? '')) ?: session('user_name') }}"
                        placeholder="Your full name"
                    >
                </div>
 
                {{-- EMAIL --}}
                <div class="field-group full-width">
                    <label for="email">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        Email Address
                        <span class="field-badge">Verified</span>
                    </label>
                    <input
                        type="email"
                        value="{{ $profileData['email'] ?? session('user_email') }}"
                        disabled
                    >
                </div>
 
                {{-- PHONE --}}
                <div class="field-group">
                    <label for="phone">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.58 3.42 2 2 0 0 1 3.55 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.77a16 16 0 0 0 6.29 6.29l1.57-1.57a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Phone Number
                    </label>
                    <input
                        type="text"
                        id="phone"
                        value="{{ $profileData['phone'] ?? session('user_phone') ?? '' }}"
                        placeholder="+94 XX XXX XXXX"
                    >
                </div>
 
                {{-- ROLE --}}
                <div class="field-group">
                    <label>
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                        Account Role
                    </label>
                    <input
                        type="text"
                        value="{{ ucfirst(session('user_role') ?? 'Customer') }}"
                        disabled
                    >
                </div>
 
                {{-- ADDRESS --}}
                <div class="field-group full-width">
                    <label for="address">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Delivery Address
                    </label>
                    <textarea id="address" placeholder="Your delivery address...">{{ $profileData['address'] ?? session('user_address') ?? '' }}</textarea>
                </div>
 
            </div>
 
            {{-- Actions --}}
            <div class="form-actions">
                <button type="submit" class="updateProfile-btn" id="submit-btn">
                    <span class="btn-text">Save Changes</span>
                    <span class="btn-loader" style="display:none;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="spin"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                    </span>
                    <svg class="btn-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </button>
 
                <a href="{{ route('home') }}" class="back-home-btn">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Back to Home
                </a>
            </div>
 
        </form>
 
    </div>
</div>
 
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
 
    // Avatar preview
    document.getElementById('avatarInput').addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const preview = document.getElementById('avatarPreview');
            const letter  = document.getElementById('avatarLetter');
            preview.src           = URL.createObjectURL(file);
            preview.style.display = 'block';
            letter.style.display  = 'none';
        }
    });
 
    // Profile update
    document.getElementById('profile-form').addEventListener('submit', async function (e) {
 
        e.preventDefault();
 
        const btn      = document.getElementById('submit-btn');
        const btnText  = btn.querySelector('.btn-text');
        const btnLoader= btn.querySelector('.btn-loader');
        const btnArrow = btn.querySelector('.btn-arrow');
 
        // Loading state
        btn.disabled            = true;
        btnText.textContent     = 'Saving...';
        btnLoader.style.display = 'inline-flex';
        btnArrow.style.display  = 'none';
 
        const formData = new FormData();
        formData.append('name',    document.getElementById('name').value);
        formData.append('phone',   document.getElementById('phone').value);
        formData.append('address', document.getElementById('address').value);
 
        const avatarInput = document.getElementById('avatarInput');
        if (avatarInput.files[0]) {
            formData.append('avatar', avatarInput.files[0]);
        }
 
        try {
            const response = await fetch("{{ route('profile.update') }}", {
                method:  'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept':       'application/json'
                },
                body: formData
            });
 
            const result = await response.json();
 
            if (response.ok) {
 
                // Update avatar name display
                const fullName = ((result.customer.first_name ?? '') + ' ' + (result.customer.last_name ?? '')).trim();
                document.getElementById('name').value    = fullName;
                document.getElementById('phone').value   = result.customer.phone   ?? '';
                document.getElementById('address').value = result.customer.address ?? '';
                document.querySelector('.avatar-name').textContent = fullName;
 
                if (result.customer.avatar) {
                    document.getElementById('avatarPreview').src           = result.customer.avatar;
                    document.getElementById('avatarPreview').style.display = 'block';
                    document.getElementById('avatarLetter').style.display  = 'none';
                }
 
                // Success toast via SweetAlert if available, else alert
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon:              'success',
                        title:             'Profile Updated!',
                        text:              'Your changes have been saved successfully.',
                        timer:             2000,
                        showConfirmButton: false,
                        background:        '#0e0d0b',
                        color:             '#f0ebe0',
                        iconColor:         '#c8a96e',
                    });
                } else {
                    alert('Profile Updated Successfully');
                }
 
            } else {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ icon: 'error', title: 'Update Failed', text: result.message || 'Please try again.' });
                } else {
                    alert(result.message || 'Update Failed');
                }
            }
 
        } catch (error) {
            console.error(error);
            alert('Something went wrong.');
        } finally {
            // Reset button
            btn.disabled            = false;
            btnText.textContent     = 'Save Changes';
            btnLoader.style.display = 'none';
            btnArrow.style.display  = 'inline';
        }
    });
 
});
</script>
@endpush
 