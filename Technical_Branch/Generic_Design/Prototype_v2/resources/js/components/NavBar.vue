<template>
    <nav class="main-header navbar navbar-expand navbar-light bg-light">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link to="/" class="nav-link">Home</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/products" class="nav-link">Products</router-link>
                </li>            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'NavBar',
};
</script>

<style scoped>
/* Styling the navbar container */
.main-header {
    background-color: #f8f9fa;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Styling the navbar items */
.navbar-nav {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-item {
    margin-right: 15px;
}

/* Styling the links inside the navbar */
.nav-link {
    color: #007bff;
    text-decoration: none;
    font-size: 1.1em;
}

.nav-link:hover {
    color: #0056b3;
}

/* Add hover effect for nav links */
.nav-link:focus,
.nav-link:hover {
    text-decoration: underline;
}

/* Make sure the navbar is responsive on smaller screens */
@media (max-width: 768px) {
    .navbar-nav {
        flex-direction: column;
        align-items: center;
    }
}
</style>
