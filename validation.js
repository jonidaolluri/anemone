$().ready(function() {
    $("#product-f").validate({
        rules: {
            name: {
                required: true,
                minlength: 4
            },
            category: {
                required: true
            },
            color: {
                required: true
            },
            description: {
                required: true,
                minlength: 5
            },
            price: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter the product name",
                minlength: "Name should be at least 4 characters"
            },
            category: {
                required: "Please choose a category"
            },
            color: {
                required: "Please enter the product color"
            },
            description: {
                required: "Please enter the product description",
                minlength: "Description should be at least 5 characters"
            },
            price: {
                required: "Please enter the product price"
            }
        }
    });
    $("#login-f").validate({
        rules: {
            lemail: {
                required: true,
                email: true
            },
            lpassword: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            lpassword: {
                required: "Please enter your password",
                minlength: "Password should have at least 5 characters"
            },
            lemail: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            }
        }
    });
    $("#register-f").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            lastname: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 3,
            },
            cpassword: {
                required: true,
                minlength: 3,
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name should be at least 2 characters"
            },
            lastname: {
                required: "Please enter your last name",
                minlength: "Last name should be at least 2 characters"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please enter your password",
                minlength: "Password should have at least 5 characters"
            },
            cpassword: {
                required: "Please confirm your password",
                minlength: "Password should have at least 5 characters"
            }
        }
    });
    $("#checkout").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            lastname: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true
            },
            address: {
                required: true
            },
            country: {
                required: true
            },
            city: {
                required: true
            },
            method: {
                required: true
            },
            cardnumber: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name should be at least 2 characters"
            },
            lastname: {
                required: "Please enter your last name",
                minlength: "Last name should be at least 2 characters"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            phone: {
                required: "Please enter your phone number",
            },
            address: {
                required: "Please enter your address",
            },
            country: {
                required: "Please enter your country",
            },
            city: {
                required: "Please select your city",
            },
            method: {
                required: "Please select a method",
            },
            cardnumber: {
                required: "Please enter your cardnumber",
            },
        }
    });
    
  
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Letters only please");
});