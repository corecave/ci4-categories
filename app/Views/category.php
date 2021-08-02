<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Categories App</title>
	<script src="//unpkg.com/alpinejs" defer></script>
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

</head>

<body>

	<div class="container px-16">
		<h1 class="text-center text-3xl font-semibold py-4">Categories App</h1>
		<hr class="my-3">
		<div class="flex justify-evenly" x-data="App.categories()" x-init="init">
			<div class="flex flex-col w-full mr-2">
				<label for="main" class="py-2">Main Category</label>
				<select name="main" id="main" class="p-3 w-full" :disabled="loading" x-model="selectedParent">
					<template x-if="loading">
						<option value="" selected>
							Loading...
						</option>
					</template>
					<template x-if="!loading">
						<option value="" selected>
							-- Choose --
						</option>
					</template>
					<template x-for="parent in parents">
						<option :value="parent.id" x-text="parent.title"></option>
					</template>
				</select>
			</div>
			<div class="flex flex-col w-full mx-2">
				<label for="sub" class="py-2">Sub Category</label>
				<select name="sub" id="sub" class="p-3 w-full" :disabled="loadingChilds" x-model="selectedChild">
					<template x-if="loadingChilds">
						<option value="" selected>
							Loading...
						</option>
					</template>
					<template x-if="!loadingChilds">
						<option value="" selected>
							-- Choose --
						</option>
					</template>
					<template x-for="child in childs">
						<option :value="child.id" x-text="child.title"></option>
					</template>
				</select>
			</div>
			<div class="flex flex-col w-full ml-2">
				<label for="sub" class="py-2">Sub-Sub Category</label>
				<select name="sub" id="sub" class="p-3 w-full" :disabled="loadingSubChilds">
					<template x-if="loadingSubChilds">
						<option value="" selected>
							Loading...
						</option>
					</template>
					<template x-if="!loadingSubChilds">
						<option value="" selected>
							-- Choose --
						</option>
					</template>
					<template x-for="grandchild in grandchilds">
						<option :value="grandchild.id" x-text="grandchild.title"></option>
					</template>
				</select>
			</div>
		</div>
	</div>

	<script>
		window.App = {
			categories: function() {

				return {
					baseURL: "<?= env('app.baseURL') ?>",
					loading: false,
					loadingChilds: false,
					loadingSubChilds: false,
					selectedParent: "",
					selectedChild: "",
					parents: [],
					childs: [],
					grandchilds: [],


					init: function() {
						this.fetchParents()

						this.$watch('selectedParent', ($value) => {
							this.fetchChilds($value)
						});
						this.$watch('selectedChild', ($value) => {
							this.fetchSubChilds($value)
						});

					},
					fetchParents: async function() {
						this.loading = true;
						this.parents = await this.fetch(`${this.baseURL}/category/parents`);
						this.loading = false;
					},
					fetchChilds: async function(category) {
						this.loadingChilds = true;

						if (!category) {
							this.childs = [];
						} else {
							this.childs = await this.fetch(`${this.baseURL}/category/childs/` + category);
						}

						this.loadingChilds = false;
					},
					fetchSubChilds: async function(category) {
						this.loadingSubChilds = true;

						if (!category) {
							this.grandchilds = [];
						} else {
							this.grandchilds = await this.fetch(`${this.baseURL}/category/childs/` + category);
						}

						this.loadingSubChilds = false;
					},
					fetch: async function(url) {
						const resp = await fetch(url, {
							method: 'POST',
							headers: {
								'<?= env('security.headerName') ?>': '<?= csrf_hash() ?>'
							},
						});

						return await resp.json();
					}
				};
			}
		}
	</script>

</body>

</html>