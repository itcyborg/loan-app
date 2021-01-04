import Dashboard from './components/Dashboard';
import Users from './components/Users';
import Product from './components/Product';
import Loans from './components/Loans';
import Repayment from './components/Repayment';
import Client from './components/Clients';
import Charge from './components/Charge';


export default {
    mode: 'history',

    routes:[
        {
            path:'/',
            component:Dashboard
        },
        {
            path: '/user',
            component:Users
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
