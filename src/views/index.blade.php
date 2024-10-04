<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <meta name="path" content="{{ config('stage-login.host_path').route('stage-login.verify',[],false) }}" />
    <title>{{ config('stage-login.title') }}</title>
    <meta name="robots" content="noindex,nofollow">

    <style>
        html,body {
            height: 100%;
        }
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            font-family: Helvetica, Arial, sans-serif;
            justify-content: center;
        }

        header, main {
            width: 500px;
            max-width: 90%;
            padding: 30px;
            margin: 0 auto 30px auto;
            text-align: center;
        }

        header {
            font-size: 2rem;
        }

        main {
            border: 1px solid #ccc;
        }

        main input {
            font-size: 1.6rem;
        }
        button {
            font-size: 1.2rem;
            appearance: textfield;
            -webkit-appearance: textfield;
            background: #000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            box-shadow: none;
            border-radius: 10px;
        }

        #error {
            color: #f00;
            margin-top: 20px;
            display: none;
        }
        .instructions {
            line-height: 1.4rem;
        }
    </style>


</head>
<body>

<div class="stage-login">
    <header>
        {{ config('stage-login.title') }}
    </header>
    <main>
        <div class="instructions">
            If you are authorised to access this application,
            please enter the access code that begins with
            "{{ config('stage-login.prefix') }}"
        </div>

        <form autocomplete="off" method="post" action="." id="form">
            <div style="margin: 20px auto">
                <input required autofocus type="text" name="code" />
            </div>

            {{ csrf_field() }}

            <button>Continue</button>

            <div id="error">Sorry, that code was not recognised</div>
        </form>
    </main>

</div>
<script>
    let form = document.getElementById('form');

	async function submit() {
        let path = document.querySelector('meta[name=path]').content || '';

		let response = await fetch(path,{
			method: 'post',
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            body: new FormData(form)
        })

        if(!response.ok) {
			document.getElementById('error').style.display = 'block';
			return;
        }

		window.location.reload();
	}

	form.addEventListener('submit',function(e) {
		e.preventDefault();
		submit();
    })
</script>
</body>
</html>
