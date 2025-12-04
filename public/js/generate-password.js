$(document).ready((function(){
    window.generatePassword = function () {
        const length = 8;
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        let password = "";
        let hasUpper = false, hasLower = false, hasDigit = false;
        
        while (password.length < length || !hasUpper || !hasLower || !hasDigit) {
            let char = charset.charAt(Math.floor(Math.random() * charset.length));
            password += char;

            if (char >= 'A' && char <= 'Z') hasUpper = true;
            if (char >= 'a' && char <= 'z') hasLower = true;
            if (char >= '0' && char <= '9') hasDigit = true;
        }

        return password;
    };
}));
