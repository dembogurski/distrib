;(function($) {

	function validateDate(text) {
		var characters = text.replace(/\D/g, "");

		var numbers = text.split("/");

		if(characters.length === 8) {
			
			var day = parseInt(numbers[0]);
			var month = parseInt(numbers[1]);
			var year = parseInt(numbers[2]);

			if((numbers[0].length !== 2) || (numbers[1].length !== 2) || (numbers[2].length !== 4)) { 
				return false;
			}

			/*
			* MONTHS
			*
			* January 	= 1 	--> 31 days
			* February 	= 2 	--> 28 or 29 days
			* March 	= 3 	--> 31 days
			* April 	= 4 	--> 30 days
			* May 		= 5 	--> 31 days
			* June 		= 6 	--> 30 days
			* Jully 	= 7 	--> 31 days
			* August 	= 8 	--> 31 days
			* September = 9 	--> 30 days
			* October 	= 10 	--> 31 days
			* November	= 11 	--> 30 days
			* Dezember 	= 12 	--> 31 days
			* 
			*/
		
			if((month === 4) || (month === 6) || (month === 9) || (month === 11)) {
				if(day > 30) { 
					return false;
				} else {
					return true;
				}
			} else if (month === 2) { 
				if((year % 4 === 0) || (year % 400 === 0)) {
					if(day > 29) {
						return false;
					} else {
						return true;
					}
				} else {
					if(day > 28) {
						return false;
					} else {
						return true;
					}
				}
			} else if ((month === 1) || (month === 3) || (month === 5) || (month === 7) || (month === 8) || (month === 10) || (month === 12)) { //Verifica os outros meses, que possuem 30 dias
				if(day > 31) {
					return false;
				} else {
					return true;
				}
			}
		}

		return false;
	}

	$.fn.dateValidation = function() {			

		return this.each(function() {
			var $this = $(this);

			var onElementBlur = function() {
				var text = $this.val();

				if(validateDate(text)) {
					$this.removeClass("wrong-date");
					$this.addClass("correct-date");
				} else {
					$this.removeClass("correct-date");
					$this.addClass("wrong-date");
				}
			}

			$this.on("blur.validationDate", onElementBlur);
		});
	}

})(jQuery);
