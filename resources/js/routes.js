import Dashboard from './Pages/Dashboard';

import Users from './Pages/Users/Users';
import CreateUser from './Pages/Users/CreateUser';
import EditUser from './Pages/Users/EditUser';

import Product from './Pages/Product/Product';
import CreateProduct from './Pages/Product/CreateProduct';
import EditProduct from './Pages/Product/EditProduct';

import Loans from './Pages/Loans/Loans';
import CreateLoan from './Pages/Loans/CreateLoan';
import EditLoan from './Pages/Loans/EditLoan';

import Repayment from './Pages/Repayment/Repayment';

import Client from './Pages/Client/Clients';
import CreateClient from './Pages/Client/CreateClient';
import EditClient from './Pages/Client/EditClient';

import Charge from './Pages/Charge/Charge';
import CreateCharge from './Pages/Charge/CreateCharge';
import EditCharge from './Pages/Charge/EditCharge';


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
            path:'/user/:id',
            component:EditUser,
            name:'EditUser'
        },
        {
            path: '/loan',
            component:Loans
        },
        {
            path: '/loan/create',
            component:CreateLoan,
            name:'CreateLoan'
        },
        {
            path: '/loan/:id',
            component:EditLoan,
            name:'EditLoan'
        },
        {
            path: '/product',
            component:Product
        },
        {
            path: '/product/create',
            component:CreateProduct
        },
        {
            path: '/product/:id',
            component:EditProduct,
            name:'EditProduct'
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
            path: '/charge/create',
            component:CreateCharge,
            name:'CreateCharge'
        },
        {
            path: '/charge/:id',
            component:EditCharge,
            name:'EditCharge'
        },
        {
            path: '/client',
            component:Client
        },
        {
            path: '/client/create',
            component:CreateClient,
            name:'CreateClient'
        },
        {
            path: '/client/:id',
            component:EditClient,
            name:'EditClient'
        }
    ]
}
