export default [
    {
        name: 'id',
        title: '#',
        titleClass: 'center aligned',
        dataClass: 'right aligned',
        sortField: 'id'
    },
    {
        name: 'name',
        sortField: 'name',
    },
    {
        name: 'email',
        sortField: 'email'
    },
    {
        name: 'body',
        title: 'Description',
        sortField: 'body',
        titleClass: 'center aligned',
        dataClass: 'right aligned',
        callback: 'formatNumber'
    },
    // {
    //     name: '__slot:actions',
    //     title: 'Slot Actions',
    //     titleClass: 'center aligned',
    //     dataClass: 'center aligned',
    // }
]