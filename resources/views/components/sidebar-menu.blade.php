@php
    $main_menus = [
        ['name' => 'Home', 'route' => 'admin.home'],
        [
            'name' => 'Setting',
            'route' => '',
            'sub' => [
                [
                    'name' => 'User',
                    'route' => 'setting.user',
                ],
                [
                    'name' => 'Permission',
                    'route' => 'setting.permission',
                ],
                [
                    'name' => 'Role',
                    'route' => 'setting.role',
                ],
            ],
        ],
    ];
    
    $allMenus = [
        'Main Menu' => $main_menus,
    ];
@endphp
@foreach ($allMenus as $keyAll => $menus)
    <h3 class="mb-2 text-xl">{{ $keyAll }}</h3>
    <ul class="px-2 py-4 mb-5 menu menu-vertical rounded-xl bg-[#343a40] " x-data="{ opensubmenu: '' }">
        @foreach ($menus as $key => $menu)
            @if (isset($menu['sub']))
                <div>
                    <div class="hover:bg-gray-50 hover:text-black flex items-baseline p-4 rounded-lg cursor-pointer"
                        @click="opensubmenu = {{ $key }}"
                        :class="opensubmenu === {{ $key }} ? 'font-bold' : ''">
                        <i class="mr-3 bi bi-folder-fill"></i>
                        <span :class="opensubmenu === {{ $key }} ? 'underline' : ''"
                            class="hover:underline">{{ $menu['name'] }}</span>
                    </div>
                    <div x-show="opensubmenu === {{ $key }}" class="pr-0 ml-7">
                        @if (count($menu['sub']) > 0)
                            <ul x-data="{ opensubmenu1: '' }">
                                @foreach ($menu['sub'] as $key1 => $submenu1)
                                    @if (isset($submenu1['sub']))
                                        <div>
                                            <div :class="opensubmenu1 === {{ $key1 }} ? 'font-bold' : ''"
                                                @click="opensubmenu1 = {{ $key1 }}"
                                                class="hover:bg-gray-50 hover:text-black flex items-baseline p-4 rounded-lg cursor-pointer">
                                                <i class="mr-3 bi bi-folder-fill"></i>
                                                <span :class="opensubmenu1 === {{ $key1 }} ? 'underline' : ''"
                                                    class="hover:underline">{{ $submenu1['name'] }}</span>
                                            </div>
                                            <div class="pr-0 ml-7" style="padding-bottom: 0px !important"
                                                x-show="opensubmenu1 === {{ $key1 }}">
                                                @if (count($submenu1['sub']) > 0)
                                                    <ul>
                                                        @foreach ($submenu1['sub'] as $key2 => $submenu2)
                                                            <li>
                                                                <a href="{{ route($submenu2['route']) }}"
                                                                    class="hover:bg-gray-50 hover:text-black rounded-lg items-baseline @if (request()->routeIs($submenu2['route'])) active @endif"
                                                                    @if (request()->routeIs($submenu2['route'])) x-init="opensubmenu1={{ $key1 }}; opensubmenu={{ $key }}" @endif>
                                                                    <i class="bi bi-arrow-right-circle"></i>
                                                                    {{ $submenu2['name'] }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <li>
                                            <a href="{{ route($submenu1['route']) }}"
                                                class="hover:bg-gray-50 hover:text-black rounded-lg items-baseline @if (request()->routeIs($submenu1['route'])) active @endif"
                                                @if (request()->routeIs($submenu1['route'])) x-init="opensubmenu={{ $key }}" @endif>
                                                <i class="bi bi-arrow-right-circle"></i>
                                                {{ $submenu1['name'] }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @else
                <li>
                    <a href="{{ route($menu['route']) }}"
                        class="hover:bg-gray-50 hover:text-black rounded-lg items-baseline @if (request()->routeIs($menu['route'])) active @endif">
                        <i class="bi bi-arrow-right-circle"></i>
                        {{ $menu['name'] }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
@endforeach
