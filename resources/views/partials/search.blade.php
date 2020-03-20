<div class="form-group search">
    <form method="POST" action="/search">
        @csrf
        <button aria-label="Search" type="submit" class="searchButton"><i class="fa fa-search" aria-hidden="true"></i></button>
        <input type="text" name="query" class="form-control searchInput" id="search"
            placeholder="Search..." required>
        <label style="display: none;" for="search">Search</label>
    </form>
</div>