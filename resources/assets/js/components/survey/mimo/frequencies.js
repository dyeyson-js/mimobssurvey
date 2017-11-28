const frequencies = [
    {
        name: 'weekly',
        label: 'Weekly',
        operation: '*',
        base: 4
    },
    {
        name: 'quarterly',
        label: 'Quarterly',
        operation: '/',
        base: 3
    },
    {
        name: 'semi-annual',
        label: 'Semi-Annual',
        operation: '/',
        base: 6
    },
    {
        name: 'annual',
        label: 'Annual',
        operation: '/',
        base: 12
    },
    {
        name: 'twice_a_month',
        label: 'Twice a month',
        operation: '*',
        base: 2
    },
    {
        name: 'every_two_months',
        label: 'Every Two Months',
        operation: '/',
        base: 2
    },
];

export default frequencies;