{{--menu component script--}}
<script>
    Vue.config.devtools = true;

    {{--draggable components--}}
    Vue.component('nested-draggable', {
        props: {
            value: {
                required: false,
                type: Array,
                default: null
            },
            list: {
                required: false,
                type: Array,
                default: null
            }
        },
        name: "nested-draggable",
        template: `@include('livewire.menu._draggable')`,
        data() {
            return {
                show: true,
            }
        },
        methods: {
            emitter(value) {
                this.$emit("input", value);
            },
            edit(el) {
                this.$root.edit(el);
            },
            destroy(el) {
                this.$root.destroy(el);
            },
        },
        computed: {
            dragOptions() {
                return {
                    animation: 0,
                    group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                };
            },
            // this.value when input = v-model
            // this.list  when input != v-model
            realValue() {
                return this.value ? this.value : this.list;
            }
        },
    });

    {{-- init vue app --}}
    document.addEventListener('DOMContentLoaded', function () {
        window.lw = @this;

        const listData = @js($list);
        const pagesData = @js($pages);

        const app = new Vue({
            el: '#menuApp',
            data: {
                list: listData,
                pages: pagesData,
                isEdit: true,
                selected: {
                    "id": "",
                    "text": "",
                    "type": "",
                    "url": "",
                    "sub": [],
                },
                tipe: [
                    {
                        value: 'link',
                        text: 'Link',
                    },
                    {
                        value: 'dropdown',
                        text: 'Dropdown',
                    },
                    {
                        value: 'page',
                        text: 'Page',
                    }
                ]
            },
            methods: {
                refresh() {
                    console.log('refresh');
                },
                create() {
                    console.log('create : ' + lwComponent);
                },
                edit(el) {
                    lw.call('edit', el);
                },
                destroy(el) {
                    lw.call('destroy', el.id);
                },
                removeArray(array, id) {
                    this.isEdit = true;
                    return array.some((o, i, a) => {
                            if (o.id === id) {
                                return a.splice(i, 1);
                            } else {
                                return this.removeArray(o.sub || "", id);
                            }
                        }
                    );
                },
                saveList() {
                    lw.call('saveList', this.list);
                },
                resetList() {
                    lw.call('resetList')
                }
            }
        });

        Livewire.on('refresh', (list) => {
            app.list = list;
        })
    })

</script>
