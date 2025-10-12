@extends('frontend.layouts.includes.master')

@section('maincontent')
<!-- Enhanced Overlay / Modal for branch selection -->
<div id="branchModal" class="branch-modal">
    <div class="branch-modal-backdrop"></div>
    <div class="branch-modal-content">
        <div class="modal-icon">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="url(#gradient)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9 22V12H15V22" stroke="url(#gradient)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <defs>
                    <linearGradient id="gradient" x1="3" y1="2" x2="21" y2="22" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#0038A6"/>
                        <stop offset="1" stop-color="#0070FF"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <h3 class="modal-title">Welcome!</h3>
        <p class="modal-subtitle">Please select your preferred branch to continue</p>

        <form action="{{ url('/select-branch') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="branch" class="form-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Choose Your Branch
                </label>
                <div class="select-wrapper">
                    <select name="branch" id="branch" class="form-control" required>
                        <option value="">-- Select a branch --</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                    <div class="select-arrow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="themebtu">
                    <span>Continue</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Full screen overlay */
    .branch-modal {
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        animation: modalFadeIn 0.3s ease-out;
    }

    .branch-modal-backdrop {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        animation: backdropFadeIn 0.4s ease-out;
    }

    .branch-modal-content {
        position: relative;
        background: #ffffff;
        padding: 45px 40px;
        border-radius: 20px;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: modalSlideUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        transform-origin: center;
    }

    .modal-icon {
        text-align: center;
        margin-bottom: 20px;
        animation: iconBounce 0.8s ease-out 0.3s both;
    }

    .modal-title {
        text-align: center;
        font-size: 28px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }

    .modal-subtitle {
        text-align: center;
        font-size: 15px;
        color: #718096;
        margin-bottom: 30px;
        line-height: 1.5;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .select-wrapper {
        position: relative;
    }

    .form-control {
        width: 100%;
        padding: 16px 45px 16px 18px;
        font-size: 16px;
        color: #2d3748;
        background: #f7fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        appearance: none;
        transition: all 0.3s ease;
        cursor: pointer;
        font-weight: 500;
    }

    .form-control:focus {
        outline: none;
        border-color: #0070FF;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(0, 112, 255, 0.1);
    }

    .form-control:hover {
        border-color: #cbd5e0;
    }

    .select-arrow {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #a0aec0;
        transition: all 0.3s ease;
    }

    .form-control:focus + .select-arrow {
        color: #0070FF;
        transform: translateY(-50%) rotate(180deg);
    }

    .themebtu {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(
            135deg,
            #0038A6,
            #0050D4,
            #0070FF,
            #003070,
            #001F50
        );
        color: white;
        border: none;
        padding: 16px 40px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 56, 166, 0.4);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .themebtu:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(0, 112, 255, 0.5);
    }

    .themebtu:active {
        transform: translateY(0);
    }

    .themebtu svg {
        transition: transform 0.3s ease;
    }

    .themebtu:hover svg {
        transform: translateX(5px);
    }

    /* Animations */
    @keyframes modalFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes backdropFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes modalSlideUp {
        from {
            opacity: 0;
            transform: translateY(40px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes iconBounce {
        0% {
            opacity: 0;
            transform: scale(0) rotate(-180deg);
        }
        60% {
            transform: scale(1.1) rotate(10deg);
        }
        100% {
            opacity: 1;
            transform: scale(1) rotate(0deg);
        }
    }

    /* Responsive */
    @media (max-width: 576px) {
        .branch-modal-content {
            padding: 35px 25px;
        }

        .modal-title {
            font-size: 24px;
        }

        .modal-subtitle {
            font-size: 14px;
        }

        .themebtu {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Check if cookie exists
        function getCookie(name) {
            let value = "; " + document.cookie;
            let parts = value.split("; " + name + "=");
            if (parts.length === 2) return parts.pop().split(";").shift();
        }

        const selectedBranch = getCookie('selected_branch');
        const modal = document.getElementById('branchModal');

        // Show modal only if no branch cookie
        if(selectedBranch) {
            modal.style.display = 'none';
        } else {
            modal.style.display = 'flex';
        }
    });
</script>
@endsection
