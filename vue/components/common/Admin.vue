<template>
    <div class="page admin-layout" style="background-color:#F2F5F9 !important;">
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark md:w-48 shadow-md" style="background-color:#202935 !important;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark flex justify-start text-lg cursor-pointer font-thin">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-brand-gitlab"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M21 14l-9 7l-9 -7l3 -11l3 7h6l3 -7z" />
                        </svg>
                    </span>
                    <span class="text-gray-200 text-base">{{ hd.module.title }}</span>
                </h1>
                <div class="navbar-nav flex-row d-lg-none">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <el-image :src="hd.user.avatar" fit="cover" class="w-8 h-8"></el-image>
                            <div class="d-none d-xl-block ps-2">
                                <div>Paweł Kuna!!</div>
                                <div class="mt-1 small text-muted">UI Designer</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="#" class="dropdown-item">Set status</a>
                            <a href="#" class="dropdown-item">Profile &amp; account</a>
                            <a href="#" class="dropdown-item">Feedback</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Logout</a>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse pt-3" id="navbar-menu">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown border-b border-gray-700 pb-3 mb-3" v-for="(menu, index) in menus" :key="index">
                            <a class="nav-link show flex items-baseline" href="#navbar-base">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i :class="menu.icon"></i>
                                </span>
                                <span class="nav-link-title font-bold"> {{ menu.title }} </span>
                            </a>
                            <div class="dropdown-menu show">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <router-link
                                            :to="item.route"
                                            v-for="(item, index) in menu.items"
                                            :key="index"
                                            :class="{ 'bg-green-600 text-gray-100': item.route.name == $route.name }"
                                            class="dropdown-item hover:bg-green-600 hover:text-gray-100 font-bold"
                                        >
                                            {{ item.title }}
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none md:ml-48">
            <div class="container-xl" style="max-width:100%;">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <el-image :src="hd.user.icon" fit="cover" class="w-8 h-8"></el-image>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ hd.user.name }}</div>
                                <div class="mt-1 small text-muted">注册于{{ hd.user.created_at | fromNow }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="/system/my/edit" class="dropdown-item">我的帐户</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item" @click="hd.logout">退出</a>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrow-back-up"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        返回站点列表
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/" target="_blank">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="icon"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        网站首页
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/member" target="_blank">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="icon"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <circle cx="9" cy="7" r="4" />
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            <path d="M16 11l2 2l4 -4" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        会员中心
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://www.houdunren.com" target="_blank">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-help"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="12" r="9"></circle>
                                            <line x1="12" y1="17" x2="12" y2="17.01"></line>
                                            <path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4"></path>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        帮助文档
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="icon"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline>
                                            <line x1="12" y1="12" x2="20" y2="7.5"></line>
                                            <line x1="12" y1="12" x2="12" y2="21"></line>
                                            <line x1="12" y1="12" x2="4" y2="7.5"></line>
                                            <line x1="16" y1="5.25" x2="8" y2="9.75"></line>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        模块集
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column grid grid-cols-2 w-80 p-3">
                                            <a
                                                class="dropdown-item"
                                                :href="`/${module.name}/site/${hd.site.id}/admin`"
                                                v-for="module in modules"
                                                :key="module.id"
                                            >
                                                {{ module.title }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="content md:ml-48">
            <!-- 历史快捷菜单 -->
            <hd-history-menu />
            <div class="p-5 bg-white mx-5 mb-10 rounded-sm border border-gray-100">
                <router-view></router-view>
            </div>
        </div>
        <el-backtop> </el-backtop>
    </div>
</template>

<script>
export default {
    props: ['menus'],
    data() {
        return {
            modules: [],
            routeName: window.localStorage.getItem('route_name')
        }
    },
    async created() {
        this.modules = await this.axios.get(`/api/module/site/${this.hd.site.id}/user`)
    },

    methods: {
        go(menu) {
            this.$router.push(menu.route)
        }
    }
}
</script>

<style>
.admin-layout .el-divider__text {
    font-size: 0.8rem;
    opacity: 0.7;
    background-color: #f1f1f1 !important;
}
</style>
