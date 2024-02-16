<section class="section">
    <div class="container container-space">
        <div class="row">
            <div class="col">
                <div class="wrap-center wrap-col wrap-space">
                    <h2 class="t3">{{ isset($title) ? $title : 'Обратная связь' }}</h2>
                    <p class="text-center">{{ isset($description) ? $description : 'Мы ответим вам по указаным в форме контактам' }}</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col col-12 col-md-10 col-lg-8 col-xl-6">
                <form class="form-feedback" method="POST" action="{{ route('mail.feedback') }}">
                    @csrf
                    <input class="input" type="text" name="name" id="name" placeholder="ваше имя"
                        value="{{ old('name') }}" required>
                    <input class="input" type="text" name="phone" id="phone" placeholder="контактный телефон"
                        value="{{ old('phone') }}" required>
                    <input class="input" type="email" name="email" id="email" placeholder="электронная почта"
                        value="{{ old('email') }}" required>
                    <input class="input" type="text" name="message" id="message" placeholder="текст сообщения"
                        required>

                    <div class="form-feedback-button">
                        <button class="button button-fill"
                            type="submit">{{ isset($button) ? $button : 'Отправить' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
