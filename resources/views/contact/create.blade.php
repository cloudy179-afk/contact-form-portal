<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Portal</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px 16px;
            font-family: Arial, sans-serif;
            color: #27243c;
            background: #f3f0ff;
        }

        .card {
            max-width: 620px;
            margin: 0 auto;
            padding: clamp(24px, 5vw, 40px);
            background: #ffffff;
            border: 1px solid #e7e0fa;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(76, 42, 135, 0.1);
        }

        .eyebrow {
            color: #6d28d9;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        h1 {
            margin: 12px 0;
            font-size: 32px;
        }

        .intro {
            color: #686477;
            line-height: 1.6;
        }

        label {
            display: block;
            margin: 22px 0 8px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #d7d1e5;
            border-radius: 12px;
            font: inherit;
            color: inherit;
            background: #fcfbff;
        }

        input:focus,
        textarea:focus {
            outline: 3px solid #ede4ff;
            border-color: #7c3aed;
        }

        input.is-invalid,
        textarea.is-invalid {
            border-color: #dc2626;
            background: #fff7f7;
        }

        input.is-invalid:focus,
        textarea.is-invalid:focus {
            outline-color: #fee2e2;
        }

        .field-error {
            margin: 6px 0 0;
            color: #b91c1c;
            font-size: 14px;
            line-height: 1.5;
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        button {
            width: 100%;
            margin-top: 24px;
            padding: 15px;
            border: 0;
            border-radius: 12px;
            background: #6d28d9;
            color: #ffffff;
            font: inherit;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #5b21b6;
        }

        button:focus-visible {
            outline: 3px solid #a78bfa;
            outline-offset: 3px;
        }

        .notice {
            margin-top: 20px;
            padding: 14px 18px;
            border-radius: 12px;
            line-height: 1.5;
        }

        .success {
            color: #166534;
            background: #dcfce7;
        }

        .errors {
            color: #991b1b;
            background: #fee2e2;
        }

        .errors ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <main class="card">
        <p class="eyebrow">CONTACT FORM PORTAL</p>
        <h1>Let's talk.</h1>

        <p class="intro">
            Have a question or an idea? Send us a message.
            All fields are required.
        </p>

        @if (session('success'))
            <div class="notice success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="notice errors" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" novalidate>
            @csrf

            <label for="name">Full name</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ is_string(old('name')) ? old('name') : '' }}"
                class="@error('name') is-invalid @enderror"
                autocomplete="name"
                minlength="2"
                maxlength="100"
                aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                @error('name') aria-describedby="name-error" @enderror
                required
            >

            @error('name')
                <p id="name-error" class="field-error">
                    {{ $message }}
                </p>
            @enderror

            <label for="email">Email address</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ is_string(old('email')) ? old('email') : '' }}"
                class="@error('email') is-invalid @enderror"
                autocomplete="email"
                maxlength="255"
                aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                @error('email') aria-describedby="email-error" @enderror
                required
            >

            @error('email')
                <p id="email-error" class="field-error">
                    {{ $message }}
                </p>
            @enderror

            <label for="subject">Subject</label>
            <input
                id="subject"
                name="subject"
                type="text"
                value="{{ is_string(old('subject')) ? old('subject') : '' }}"
                class="@error('subject') is-invalid @enderror"
                minlength="3"
                maxlength="150"
                aria-invalid="{{ $errors->has('subject') ? 'true' : 'false' }}"
                @error('subject') aria-describedby="subject-error" @enderror
                required
            >

            @error('subject')
                <p id="subject-error" class="field-error">
                    {{ $message }}
                </p>
            @enderror

            <label for="message">Your message</label>
            <textarea
                id="message"
                name="message"
                class="@error('message') is-invalid @enderror"
                minlength="10"
                maxlength="5000"
                placeholder="Write at least 10 characters..."
                aria-invalid="{{ $errors->has('message') ? 'true' : 'false' }}"
                @error('message') aria-describedby="message-error" @enderror
                required
            >{{ is_string(old('message')) ? old('message') : '' }}</textarea>

            @error('message')
                <p id="message-error" class="field-error">
                    {{ $message }}
                </p>
            @enderror

            <button type="submit">Send message</button>
        </form>
    </main>
</body>
</html>