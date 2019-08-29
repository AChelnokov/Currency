
<template>
	<div>
		<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarText">

				<ul class="navbar-nav flex-column  mr-auto">
					<li class="nav-item">
						<router-link :to="{name: 'index'}" class="nav-link">Главная страница</router-link>
						<router-link :to="{name: 'orders'}" class="nav-link">Заказы</router-link>
					</li>


				</ul>

			</div>

		</nav>
		<div class="main-content">
			<transition name="fade" mode="out-in">
				<router-view></router-view>
			</transition>
		</div>
	</div>
</template>


<script>


export default {
    computed: {

	}

}
</script>
