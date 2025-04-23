<form method="POST" action="{{ isset($offer) ? route('offers.update', $offer->id) : route('offers.store') }}"
    enctype="multipart/form-data">
    @csrf
    @if (isset($offer))
        @method('PUT')
    @endif

    <div class="fib fib-col fib-gap-55">
        <div class="row">
            <div class="col col-12 col-lg">
                <h2 class="font-size-2 font-bold">Основное</h2>
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $offer->name ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="description">Краткое описание</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description', $offer->description ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="comment">Комментарий</label>
                    <textarea name="comment" id="comment" class="form-control">{{ old('comment', $offer->comment ?? '') }}</textarea>
                </div>
            </div>

            <div class="col col-12 col-lg">
                <h2 class="font-size-2 font-bold">Параметры</h2>

                <div class="form-group">
                    <label for="type">Тип записи</label>
                    <input type="text" name="type" id="type" class="form-control"
                        value="{{ old('type', $offer->type ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="group">Группа записи</label>
                    <input type="text" name="group" id="group" class="form-control"
                        value="{{ old('group', $offer->group ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="tags">Теги</label>
                    <input type="text" name="tags" id="tags" class="form-control"
                        value="{{ old('tags', $offer->tags ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="rating">Рейтинг записи</label>
                    <input type="text" name="rating" id="rating" class="form-control"
                        value="{{ old('rating', $offer->rating ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="template">Шаблон отображения</label>
                    <input type="text" name="template" id="template" class="form-control"
                        value="{{ old('template', $offer->template ?? '') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-12 col-lg">
                <h2 class="font-size-2 font-bold">Торговое</h2>

                <div class="form-group">
                    <label for="code">Уникальный код</label>
                    <input type="text" name="code" id="code" class="form-control"
                        value="{{ old('code', $offer->code ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="price">Цена</label>
                    <input type="number" step="1" name="price" id="price" class="form-control"
                        value="{{ old('price', $offer->price ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="sale">Новая цена</label>
                    <input type="number" name="sale" id="sale" class="form-control"
                        value="{{ old('sale', $offer->sale ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="unit">Единица измерения</label>
                    <input type="text" name="unit" id="unit" class="form-control"
                        value="{{ old('unit', $offer->unit ?? '') }}">
                </div>
            </div>

            <div class="col col-12 col-lg">
                <h2 class="font-size-2 font-bold">Количество</h2>
                <div class="form-group">
                    <label for="stock">Общее количество</label>
                    <input type="number" name="stock" id="stock" class="form-control"
                        value="{{ old('stock', $offer->stock ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="min">Минимальное количество</label>
                    <input type="number" name="min" id="min" class="form-control"
                        value="{{ old('min', $offer->min ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="step">Шаг увеличения</label>
                    <input type="number" name="step" id="step" class="form-control"
                        value="{{ old('step', $offer->step ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="max">Максимальное количество</label>
                    <input type="number" name="max" id="max" class="form-control"
                        value="{{ old('max', $offer->max ?? '') }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-12 col-lg">
                <h2 class="font-size-2 font-bold">Метаданные</h2>
                <div class="form-group">
                    <label for="meta_title">SEO заголовок</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control"
                        value="{{ old('meta_title', $offer->meta_title ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="meta_description">SEO описание</label>
                    <textarea name="meta_description" id="meta_description" class="form-control">{{ old('meta_description', $offer->meta_description ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="meta_favicon">SEO ключевые слова</label>
                    <textarea name="meta_favicon" id="meta_favicon" class="form-control">{{ old('meta_favicon', $offer->meta_favicon ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="meta_favicon">SEO иконка страницы</label>
                    <input type="text" name="meta_favicon" id="meta_favicon" class="form-control"
                        value="{{ old('meta_favicon', $offer->meta_favicon ?? '') }}">
                </div>
            </div>

            <div class="col col-12 col-lg">
                <h2 class="font-size-2 font-bold">Медиаконтент</h2>
                <div class="form-group">
                    <label for="image">Главное изображение</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if (isset($offer->image))
                        <img src="{{ asset('storage/' . $offer->image) }}" width="100" class="mt-2">
                    @endif
                </div>

                <div class="form-group">
                    <label for="wallpaper">Фоновое изображение</label>
                    <input type="file" name="wallpaper" id="wallpaper" class="form-control">
                    @if (isset($offer->wallpaper))
                        <img src="{{ asset('storage/' . $offer->wallpaper) }}" width="100"
                            class="mt-2">
                    @endif
                </div>

                <div class="form-group">
                    <label for="video">Ссылка на видео</label>
                    <input type="text" name="video" id="video" class="form-control"
                        value="{{ old('video', $offer->video ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="link">Сторонняя ссылка</label>
                    <input type="text" name="link" id="link" class="form-control"
                        value="{{ old('link', $offer->link ?? '') }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-12 col-lg">
                <h2 class="font-size-2 font-bold">Дополнительно</h2>

                <div class="form-group">
                    <label for="content">Полное описание</label>
                    <textarea name="content" id="content" class="form-control" rows="10">{{ old('content', $offer->content ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="data">Параметры json</label>
                    <textarea name="data" id="data" class="form-control" rows="20">{{ old('data', $offer->data ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col col-auto">
                <button type="submit"
                    class="fib-button hover-accent">{{ isset($offer) ? 'Сохранить изменения' : 'Создать' }}</button>
            </div>
        </div>

    </div>
</form>
