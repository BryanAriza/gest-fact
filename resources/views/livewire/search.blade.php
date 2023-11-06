<ul class="navbar-item flex-row search-ul">
    <li class="nav-item align-self-center search-animated">
       <form class="form-inline search-full form-inline search" role="search">
            <div class="search-bar">
                <!--<input id="code" type="text" 
                wire:keydown.enter.prevent="$emit('scan-code', $('#code').val())" 
                class="form-control search-form-control  ml-lg-auto" 
                placeholder="Buscar..." style="place">-->
            </div>
        </form>
    </li>
</ul>


<script>
    document.addEventListener('DOMContentLoaded', function(){
            livewire.on('scan-code', action => {
                $('#code').val('')
            })
    })
</script>