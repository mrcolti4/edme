<div class="flex items-center justify-center gap-2 text-white mx-auto mt-[50px]" x-data="{
    breadcrumbs: @js($breadcrumbs),

    init() {
        document.addEventListener('wireui::breadcrumbs', ({ detail }) => {
            this.breadcrumbs = detail
        })
    }
}">

    <template x-for="trail in breadcrumbs" :key="trail.url + trail.label">
        <div class="flex items-center gap-2 font-opensans group">
            <a x-text="trail.label" :href="trail.url && trail.url" class="text-white hover:underline"></a>
            <i class="fas fa-long-arrow-alt-right group-last:hidden"></i>
        </div>
    </template>
</div>
