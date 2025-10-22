<flux:sidebar sticky collapsible="mobile"
    class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.header>
        <flux:sidebar.brand href="#" logo="https://fluxui.dev/img/demo/logo.png"
            logo:dark="https://fluxui.dev/img/demo/dark-mode-logo.png" name="SiteTrackr" />
        <flux:sidebar.collapse class="lg:hidden" />
    </flux:sidebar.header>
    {{-- <flux:sidebar.search placeholder="Search..." /> --}}
    <flux:sidebar.nav>
        {{-- <flux:sidebar.item icon="home" href="#" current>Home</flux:sidebar.item>
        <flux:sidebar.item icon="inbox" badge="12" href="#">Inbox</flux:sidebar.item>
        <flux:sidebar.item icon="document-text" href="#">Documents</flux:sidebar.item>
        <flux:sidebar.item icon="calendar" href="#">Calendar</flux:sidebar.item> --}}
        <flux:sidebar.group expandable expanded="false" heading="Masters" class="grid">
            <flux:sidebar.group expandable expanded="false" badge="{{ \App\Models\Labor::count() }}" heading="Labor" class="grid">
                <flux:sidebar.item href="{{ route('labor.create') }}">Create</flux:sidebar.item>
                <flux:sidebar.item href="{{ route('labor.index') }}">List</flux:sidebar.item>
            </flux:sidebar.group>
             <flux:sidebar.group expandable expanded="false" badge="{{ \App\Models\Customer::count() }}" heading="Customers" class="grid">
                <flux:sidebar.item href="{{ route('customer.create') }}">Create</flux:sidebar.item>
                <flux:sidebar.item href="{{ route('customer.index') }}">List</flux:sidebar.item>
            </flux:sidebar.group>
            <flux:sidebar.group expandable expanded="false" badge="{{ \App\Models\Site::count() }}" heading="Sites" class="grid">
                <flux:sidebar.item href="{{ route('site.create') }}">Create</flux:sidebar.item>
                <flux:sidebar.item href="{{ route('site.index') }}">List</flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.group>
        <flux:sidebar.group expandable heading="Transactions" class="grid">
            <flux:sidebar.group expandable expanded="false" badge="{{ \App\Models\Labor::count() }}" heading="Labor" class="grid">
                <flux:sidebar.item href="{{ route('labor.create') }}">Create</flux:sidebar.item>
                <flux:sidebar.item href="{{ route('labor.index') }}">List</flux:sidebar.item>
            </flux:sidebar.group>
             <flux:sidebar.group expandable expanded="false" badge="{{ \App\Models\Customer::count() }}" heading="Customers" class="grid">
                <flux:sidebar.item href="{{ route('customer.create') }}">Create</flux:sidebar.item>
                <flux:sidebar.item href="{{ route('customer.index') }}">List</flux:sidebar.item>
            </flux:sidebar.group>
            <flux:sidebar.group expandable expanded="false" badge="{{ \App\Models\Site::count() }}" heading="Sites" class="grid">
                <flux:sidebar.item href="{{ route('site.create') }}">Create</flux:sidebar.item>
                <flux:sidebar.item href="{{ route('site.index') }}">List</flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.group>
    </flux:sidebar.nav>
    <flux:sidebar.spacer />
    <flux:sidebar.nav>
        <flux:sidebar.item icon="cog-6-tooth" href="#">Settings</flux:sidebar.item>
        <flux:sidebar.item icon="information-circle" href="#">Help</flux:sidebar.item>
    </flux:sidebar.nav>
    <flux:dropdown position="top" align="start" class="max-lg:hidden">
        <flux:sidebar.profile avatar="https://fluxui.dev/img/demo/user.png" name="{{ auth()->user()->name }}    " />
        <flux:menu>
            {{-- <flux:menu.separator /> --}}
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>
            <flux:menu.item onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>

        </flux:menu>
    </flux:dropdown>
</flux:sidebar>
<flux:header class="block! bg-white lg:bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <flux:navbar class="lg:hidden w-full">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <flux:spacer />
        <flux:dropdown position="top" align="start">
            <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />
            <flux:menu>
                <flux:menu.separator />
                <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:navbar>
    <flux:navbar scrollable>
        <flux:navbar.item href="#" current>Dashboard</flux:navbar.item>
        <flux:navbar.item badge="32" href="#">Orders</flux:navbar.item>
        <flux:navbar.item href="#">Catalog</flux:navbar.item>
        <flux:navbar.item href="#">Configuration</flux:navbar.item>
    </flux:navbar>
</flux:header>
