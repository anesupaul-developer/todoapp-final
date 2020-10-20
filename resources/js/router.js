import Vue from 'vue';
import VueRouter from 'vue-router';
import LogOut from './components/LogOut';
import TodoList from './components/TodoList';
import TodoListCompleted from './components/TodoListCompleted';
import TodoCreate from './components/TodoCreate';
import Login from './components/Login';
import Register from './components/Register';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [{
        path: '/auth/logout',
        component: LogOut,
    },
    {
        path: '/auth/register',
        component: Register,
    },
    {
        path: '/auth/login',
        component: Login,
    },
    {
        path: '/todolist',
        component: TodoList,
    },
    {
        path: '/todolist/completed',
        component: TodoListCompleted
    },{
        path:'/todolist/create',
        component: TodoCreate
    }],
    mode: 'history'
});