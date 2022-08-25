@props(['classes' => ''])

<div>
    <li class="nav-item dropdown">
        <a
            class="dropdown-toggle nav-link {{ $classes }}"
            data-toggle="dropdown"
            aria-expanded="false"
            href="javascript:void(0)"
        >
            {{ $parent }}
        </a>

        <div class="px-2">
            <div class="dropdown-menu" role="menu">
                {{ $slot }}
            </div>
        </div>

    </li>
</div>


<style>
    .dropdown-menu {
        padding: 0;
    }

    .nav-item > a > span {
        margin-left: 5px;
    }

    .nav-item > a > svg {
        margin-top: -3px;
    }

    .atom-nav-link {
        display: block;
        width: 100%;
        text-align: left;
        padding: 1rem;
        font-size: .85rem;
    }

    .atom-dropdown-item {
        padding: 10px;
        width: 100%;
        display: flex;
        align-items: center;
        font-size: 14px;
        border-bottom: 1px solid lightgray;
    }

    .atom-dropdown-item:hover {
        background-color: #edecec;
    }

    .atom-dropdown-item > a {
        text-decoration: none;
        color: #000000;
        margin-left: 10px;
    }
</style>