@once
    <style>
        .gj-premium-form {
            --gj-form-ink: #081427;
            --gj-form-accent: #4A90E2;
            --gj-form-accent-strong: #2266CC;
            --gj-form-border: rgba(74, 144, 226, 0.18);
            --gj-form-border-strong: rgba(74, 144, 226, 0.42);
            --gj-form-surface: rgba(255, 255, 255, 0.96);
            --gj-form-muted: #5D708C;
            position: relative;
            padding: clamp(18px, 2.2vw, 28px);
            border-radius: 24px;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.98) 0%, rgba(241, 247, 255, 0.96) 100%);
            border: 1px solid var(--gj-form-border);
            box-shadow: 0 22px 54px rgba(8, 20, 39, 0.09);
            backdrop-filter: blur(14px);
            transition: transform 0.32s ease, box-shadow 0.32s ease, border-color 0.32s ease;
        }

        .gj-premium-form:hover {
            transform: translateY(-4px);
            border-color: var(--gj-form-border-strong);
            box-shadow: 0 28px 66px rgba(8, 20, 39, 0.12);
        }

        .gj-premium-form::before {
            content: "";
            position: absolute;
            inset: 0 auto auto 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, rgba(74, 144, 226, 0) 0%, rgba(74, 144, 226, 0.7) 50%, rgba(74, 144, 226, 0) 100%);
            opacity: 0.75;
            pointer-events: none;
        }

        .gj-premium-form .row {
            --bs-gutter-x: 14px;
            --bs-gutter-y: 0;
        }

        .gj-premium-form__field {
            position: relative;
            margin-bottom: 14px;
        }

        .gj-premium-form__control,
        .gj-premium-form__field textarea,
        .gj-premium-form__field select {
            width: 100%;
            min-height: 58px;
            padding: 20px 16px 12px;
            border-radius: 16px;
            border: 1px solid rgba(9, 29, 60, 0.10);
            background: var(--gj-form-surface);
            color: var(--gj-form-ink);
            font-size: 0.96rem;
            line-height: 1.4;
            outline: none;
            transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease, background 0.22s ease;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.88);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .gj-premium-form__field textarea {
            min-height: 132px;
            resize: vertical;
            padding-top: 24px;
        }

        .gj-premium-form__field select {
            padding-right: 44px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='%232266CC' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
        }

        .gj-premium-form__control:hover,
        .gj-premium-form__field textarea:hover,
        .gj-premium-form__field select:hover {
            border-color: rgba(74, 144, 226, 0.3);
            transform: translateY(-1px);
        }

        .gj-premium-form__control:focus,
        .gj-premium-form__field textarea:focus,
        .gj-premium-form__field select:focus,
        .gj-premium-form__field.is-filled select,
        .gj-premium-form__field.is-filled .gj-premium-form__control,
        .gj-premium-form__field.is-filled textarea {
            border-color: var(--gj-form-border-strong);
            box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.12), 0 14px 26px rgba(34, 102, 204, 0.08);
            background: #fff;
        }

        .gj-premium-form__label {
            position: absolute;
            top: 18px;
            left: 15px;
            padding: 0 6px;
            font-size: 0.86rem;
            line-height: 1;
            color: var(--gj-form-muted);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.94) 0%, rgba(247, 250, 255, 0.98) 100%);
            border-radius: 999px;
            pointer-events: none;
            transition: top 0.2s ease, font-size 0.2s ease, color 0.2s ease, transform 0.2s ease;
        }

        .gj-premium-form__control:focus + .gj-premium-form__label,
        .gj-premium-form__control:not(:placeholder-shown) + .gj-premium-form__label,
        .gj-premium-form__field textarea:focus + .gj-premium-form__label,
        .gj-premium-form__field textarea:not(:placeholder-shown) + .gj-premium-form__label,
        .gj-premium-form__field.is-filled .gj-premium-form__label,
        .gj-premium-form__field select:focus + .gj-premium-form__label {
            top: -8px;
            font-size: 0.72rem;
            color: var(--gj-form-accent-strong);
            transform: translateY(-1px);
        }

        .gj-premium-form__field input::placeholder,
        .gj-premium-form__field textarea::placeholder {
            color: transparent;
        }

        .gj-premium-form__submit {
            margin-top: 6px;
            text-align: center;
        }

        .gj-premium-form__submit .themebtu,
        .gj-premium-form__submit button.themebtu,
        .gj-premium-form__submit .gj-premium-form__button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 180px;
            min-height: 54px;
            padding: 14px 28px;
            border: 0;
            border-radius: 999px;
            background: linear-gradient(135deg, #4A90E2 0%, #2266CC 100%);
            color: #fff;
            font-weight: 700;
            letter-spacing: 0.01em;
            box-shadow: 0 16px 34px rgba(34, 102, 204, 0.24);
            transition: transform 0.22s ease, box-shadow 0.22s ease, filter 0.22s ease;
        }

        .gj-premium-form__submit .themebtu:hover,
        .gj-premium-form__submit button.themebtu:hover,
        .gj-premium-form__submit .gj-premium-form__button:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 38px rgba(34, 102, 204, 0.3);
            filter: saturate(1.08);
        }

        @media (max-width: 575.98px) {
            .gj-premium-form {
                padding: 16px;
                border-radius: 20px;
            }

            .gj-premium-form__control,
            .gj-premium-form__field textarea,
            .gj-premium-form__field select {
                min-height: 54px;
                padding: 18px 14px 11px;
                border-radius: 14px;
                font-size: 0.92rem;
            }

            .gj-premium-form__field textarea {
                min-height: 120px;
            }

            .gj-premium-form__label {
                left: 13px;
            }

            .gj-premium-form__submit .themebtu,
            .gj-premium-form__submit button.themebtu,
            .gj-premium-form__submit .gj-premium-form__button {
                width: 100%;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.gj-premium-form__field select').forEach(function (select) {
                var field = select.closest('.gj-premium-form__field');
                if (!field) {
                    return;
                }

                var toggleFilled = function () {
                    field.classList.toggle('is-filled', !!select.value);
                };

                toggleFilled();
                select.addEventListener('change', toggleFilled);
            });
        });
    </script>
@endonce
