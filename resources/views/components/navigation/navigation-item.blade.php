@props(['classes' => ''])

<li class="nav-item" role="presentation">
    <div class="atom-nav-link {{ $classes }}">
        {{ $slot }}
    </div>
</li>

<style>
    .atom-nav-link {
        display: block;
        width: 100%;
        text-align: left;
        padding: 1rem;
        font-size: .85rem;
    }

    .atom-nav-link > a > i {
        padding-right: 5px;
        color: hsla(0,0%,100%,.3);
    }

    .atom-nav-link > a {
        display: flex;
        gap: 7px;
        color: hsla(0,0%,100%,.8);
    }

    .atom-nav-link > a:hover {
        color: #FFF;
        text-decoration: none;
    }

    .atom-nav-link > a:hover > i {
        color: #FFF;
    }

    .active > a {
        font-weight: bold;
        color: #FFF;
    }
</style>