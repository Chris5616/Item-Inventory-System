@extends('layouts.auth')

@section('content')
<style>
    /* ✅ Navbar brand logo fix */
    .navbar-brand-image {
        height: 60px;
        width: auto;
        object-fit: contain;
    }

    @media (max-width: 576px) {
        .navbar-brand-image {
            height: 45px;
        }
    }

    /* Prevent outer body from scrolling */
    html, body {
        height: 100%;
        margin: 0;
        overflow: hidden;
    }

    /* Container sizing */
    .terms-container {
        margin-top: 10px;
        max-width: 900px;
    }

    .terms-card {
        display: flex;
        flex-direction: column;
    }

    /* Card body flex with scrollable middle */
    .terms-body {
        display: flex;
        flex-direction: column;
    }

    /* Scroll only the terms text */
    .terms-scroll {
        max-height: 50vh;   /* 🔹 only scroll inside */
        overflow-y: auto;
        padding-right: 6px;
    }

    /* Footer button always visible */
    .terms-footer {
        margin-top: 10px;
    }

    /* Responsive tweaks */
    @media (max-width: 992px) {
        .terms-container { max-width: 95%; }
    }
    @media (max-width: 576px) {
        h2 { font-size: 1.2rem; }
        p, li { font-size: 0.9rem; }
        .btn { font-size: 1rem; padding: 10px; }
    }
</style>

<div class="container terms-container d-flex justify-content-center align-items-start">
    <div class="card terms-card shadow border-0 rounded-3 w-100">
        <div class="card-body terms-body">

            <h2 class="text-center mb-3">📜 Terms of Service</h2>
            <p class="text-muted text-center mb-3">
                Please read these terms carefully before using the <strong>Item Inventory System</strong>.
            </p>

            <!-- 🔽 Only this part scrolls -->
            <div class="terms-scroll">
                <h5 class="mt-3">1. Acceptance of Terms</h5>
                <p>By creating an account or using this system, you agree to comply with these Terms of
                    Service and our Privacy Policy.</p>

                <h5 class="mt-3">2. User Responsibilities</h5>
                <ul>
                    <li>Keep your account credentials secure and confidential.</li>
                    <li>Do not misuse the system or attempt unauthorized access.</li>
                    <li>Ensure all inventory data you provide is accurate and lawful.</li>
                </ul>

                <h5 class="mt-3">3. Content Ownership & Privacy</h5>
                <p>You retain ownership of your data. We respect your privacy and will only use your data
                    for system-related purposes unless required by law.</p>

                <h5 class="mt-3">4. System Usage</h5>
                <p>This system is designed to help manage inventory. Unauthorized use or fraudulent activity
                    may result in account suspension or termination.</p>

                <h5 class="mt-3">5. Data Protection</h5>
                <p>We take reasonable measures to secure your data, but you are encouraged to keep your own
                    backups. We are not responsible for data loss or corruption.</p>

                <h5 class="mt-3">6. Modifications</h5>
                <p>Terms may be updated from time to time. Continued use of the system indicates your
                    acceptance of the latest version.</p>

                <h5 class="mt-3">7. Limitation of Liability</h5>
                <p>The system is provided “as is” and “as available.” We are not liable for indirect or
                    consequential damages arising from use of the system.</p>

                <h5 class="mt-3">8. Governing Law</h5>
                <p>These Terms are governed by the laws of your jurisdiction. Any disputes shall be resolved
                    in the appropriate courts.</p>
            </div>

            <!-- 🔹 Button always visible -->
            <div class="terms-footer text-center">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg w-100">
                    Back to Registration
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
