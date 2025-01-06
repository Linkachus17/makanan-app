<div class="w-full max-w-7xl bg-white rounded-lg shadow-md flex justify-between items-center p-4 mb-6">
    <div class="flex-1 flex justify-center space-x-40">
        <a href="/operator/riwayat" class="text-gray-500 {{ Request::is('operator/riwayat') ? 'text-green-700 border-b-2 border-blue-500 pb-1' : '' }}">Riwayat Orderan</a>
        <a href="/operator" class="text-gray-500 {{ Request::is('operator') ? 'text-green-700 border-b-2 border-blue-500 pb-1' : '' }}">Orderan</a>
        <a href="/operator/makanan" class="text-gray-500 {{ Request::is('operator/makanan') ? 'text-green-700 border-b-2 border-blue-500 pb-1' : '' }}">List Makanan</a>
    </div>
    <div class="relative">
        <div class="bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center cursor-pointer" id="dropdownButton">A</div>
        <div class="absolute right-0 mt-2 w-48 bg-blue-300 rounded-md shadow-lg hidden" id="dropdownMenu">
            <a href="/logout" class="block px-4 py-2 text-green">Logout</a>
        </div>
    </div>
</div>

<script>
    document.getElementById('dropdownButton').addEventListener('click', function() {
        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('hidden');
    });

    // Close the dropdown if clicked outside
    window.onclick = function(event) {
        if (!event.target.matches('#dropdownButton')) {
            var dropdowns = document.getElementsByClassName("hidden");
            for (var i = 0; i < dropdowns.length; i++) {
                dropdowns[i].classList.add('hidden');
            }
        }
    }
</script>

<style>
    .hidden {
        display: none;
    }
</style>