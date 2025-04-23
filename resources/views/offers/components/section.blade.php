<section class="section section-details">
    <div class="container container-space">
        <div class="row">
            <div class="col">
                <div class="wrap-center wrap-col wrap-space">
                    <h2 class="t2">Мощные сборки</h2>
                    <div class="section-details-content">
                        <p class="section-details-list">
                            SSD <span class="t-brand">/</span>
                            DDR5 <span class="t-brand">/</span>
                            INTEL <span class="t-brand">/</span>
                            AMD <span class="t-brand">/</span>
                            RTX
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center gy-4">
            @php
                $computers = [\App\Models\Computer::find(1), \App\Models\Computer::find(2), \App\Models\Computer::find(3)];
            @endphp

            @foreach ($computers as $computer)
                <div class="col col-12 col-md-6 col-lg-4">
                    @component('computers.components.card', ['computer' => $computer])
                    @endcomponent
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col">
                <div class="wrap-center wrap-col wrap-space">
                    <p>
                        Всего <span class="section-hover-item">{{ \App\Models\Computer::all()->count() }}</span>
                        вариаций сборки <span class="section-hover-item">ПК</span> в аренду
                    </p>
                    <a class="button button-outline" href="{{ route('computers.index') }}">Каталог »</a>
                </div>
            </div>
        </div>
    </div>
</section>