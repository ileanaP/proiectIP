{{--
Pentru a lua categoriile din baza de date:
-> am creat migratia "categories"
-> am creat modelul Category (App\Category.php)
-> am creat un nou Service Provider (App\Providers\ViewComposerServiceProvider:
aici vom pune toate comenzile $view->composer() de care vom avea nevoie pentru a trimite date
din baza de date catre view-uri)
-> am importat modelul Category in noul SP
-> am creat o functie composeSidebar() pe care o apelez in functia boot a provider-ului
(cea care se apeleaza atunci cand se afiseaza un view),
in care am apelat metoda composer() a variabilei $view corespunzatoare acestei pagini (layouts.sidebar)
-> am inregistrat noul SP in config\app.php
--}}

<div class="col-md-3">
    <p class="lead">Categorii disponibile:</p>
    <div class="list-group">
        @foreach($categories as $category)
            <a href="{{ route('upcomingEvents', ['id' => $category->id]) }}" class="list-group-item">{{$category->category}}</a>
        @endforeach
    </div>
</div>