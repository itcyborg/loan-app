import Dashboard from './Pages/Dashboard';

import Users from './Pages/Users/Users';
import CreateUser from './Pages/Users/CreateUser';

import Product from './Pages/Product/Product';

import Loans from './Pages/Loans/Loans';

import Repayment from './Pages/Repayment/Repayment';

import Client from './Pages/Client/Clients';

import Charge from './Pages/Charge/Charge';


export default {
    mode: 'history',

    routes:[
        {
            path:'/',
            name:'Dashboard',
            component:Dashboard
        },
        {
            path: '/user',
            component:Users
        },
        {
            path:'/user/create',
            component:CreateUser,
            name:'CreateUser'
        },
        {
            path: '/loan',
            component:Loans
        },
        {
            path: '/product',
            component:Product
        },
        {
            path: '/repayment',
            component:Repayment
        },
        {
            path: '/charge',
            component:Charge
        },
        {
            path: '/client',
            component:Client
        }
    ]
}
