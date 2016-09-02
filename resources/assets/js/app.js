
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#ingredient-list',
		data: {
			newIngredient: '',
			newAmount: '',
			ingredients: oldIngredients || []
		},
		methods: {
			addIngredient: function () {
				let text = this.newIngredient.trim();
				let amount = this.newAmount.trim();
				if(text && amount) {
					this.ingredients.push({
						'name': text,
						amount
					});
					this.newIngredient= '';
					this.newAmount = '';
				}
			},

			removeIngredient: function(index) {
				this.ingredients.splice(index,1);
			}

		}
});

const steps = new Vue({
    el: '#step-list',
		data: {
			newStep: '',
			steps: oldSteps || []
		},
		methods: {
			addStep: function () {
				let text = this.newStep.trim();
				if(text) {
					this.steps.push({
						'description': text
					});
					this.newStep= '';
				}
			},

			removeStep: function(index) {
				this.steps.splice(index,1);
			}

		}
});
