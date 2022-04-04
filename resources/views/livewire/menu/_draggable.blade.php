<draggable
    v-bind="dragOptions"
    tag="div"
    class="dragArea"
    ghost-class="ghost"
    :list="list"
    :value="value"
    @input="emitter">
    <div class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 p-3 mb-3 border-2 border-dashed border-collapse rounded-xl" :key="el.id" v-for="el in realValue">
        <div class="item flex">
            <div class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path class="dark:fill-white" d="M16 13l6.964 4.062-2.973.85 2.125 3.681-1.732 1-2.125-3.68-2.223 2.15L16 13zm-2-7h2v2h5a1 1 0 0 1 1 1v4h-2v-3H10v10h4v2H9a1 1 0 0 1-1-1v-5H6v-2h2V9a1 1 0 0 1 1-1h5V6zM4 14v2H2v-2h2zm0-4v2H2v-2h2zm0-4v2H2V6h2zm0-4v2H2V2h2zm4 0v2H6V2h2zm4 0v2h-2V2h2zm4 0v2h-2V2h2z"/></svg>
            </div>
            <div>@{{ el.label }}</div>
            <div class="ml-auto flex justify-center items-start">
                <x-kit::button
                    variant="circle"
                    v-if="el.children.length > 0"
                    class="dark:text-white"
                    v-on:click="show = !show">
                    <div class="flex justify-center items-start" v-if="!show">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path class="dark:fill-white" d="M12 8l6 6H6z"/></svg>
                    </div>
                    <div class="flex justify-center items-start" v-else>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path class="dark:fill-white" d="M12 16l-6-6h12z"/></svg>
                    </div>
                </x-kit::button>
                <x-kit::button
                    variant="circle"
                    class="dark:text-white"
                    v-on:click="edit(el)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path class="dark:fill-white" d="M6.414 16L16.556 5.858l-1.414-1.414L5 14.586V16h1.414zm.829 2H3v-4.243L14.435 2.322a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414L7.243 18zM3 20h18v2H3v-2z"/></svg>
                </x-kit::button>
                <x-kit::button
                    variant="circle"
                    class="dark:text-white"
                    v-on:click="destroy(el)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path class="dark:fill-white" d="M17 6h5v2h-2v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8H2V6h5V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3zm1 2H6v12h12V8zm-9 3h2v6H9v-6zm4 0h2v6h-2v-6zM9 4v2h6V4H9z"/></svg>
                </x-kit::button>

            </div>
        </div>
        <nested-draggable v-show="show" v-if="el.type=='dropdown'" :list="el.children" />
    </div>
</draggable>
