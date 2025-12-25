/* eslint-disable no-undef */

async function globalSearch() {
    const form = new FormData()

    const searchValue = $('.globalSearchInput').val()

    form.append('search_name', searchValue.trim())

    const settings = {
        method: 'POST',
        timeout: 0,
        processData: false,
        mimeType: 'multipart/form-data',
        contentType: false,
        data: form,
    }

    settings.url = '/searchapi/?type=musicGlobal'
    $.ajax(settings).done(async (response) => {
        handleSearchResponse(
            response,
            $('.globalSearchResult > li:nth-child(2) > ul'),
            $('.globalSearchResult > li:nth-child(2)')
        )
    })

    settings.url = '/searchapi/?type=artistGlobal'
    $.ajax(settings).done(async (response) => {
        handleSearchResponse(
            response,
            $('.globalSearchResult > li:nth-child(3) > ul'),
            $('.globalSearchResult > li:nth-child(3)')
        )
    })

    settings.url = '/searchapi/?type=newGlobal'
    $.ajax(settings).done(async (response) => {
        handleSearchResponse(
            response,
            $('.globalSearchResult > li:nth-child(4) > ul'),
            $('.globalSearchResult > li:nth-child(4)')
        )
    })
}

const debounceDisplayGlobalSearch = debounce(globalSearch, 750)

$('.globalSearchInput').on('input', () => {
    debounceDisplayGlobalSearch()
    $(".globalSearchContainer").removeClass("inActive");
})

$(".globalSearchInput").on("click", function (element) {
    $(".globalSearchContainer").toggleClass("inActive");
});
