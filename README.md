# One Possible Solution for Loading Config into a Service from an Array

This pattern demonstrates how to build a reusable, property-based config system for services in PHP, with automatic validation of required and optional parameters.

---

## ServiceException

A generic exception class used for signaling configuration or service errors.  
You can replace this with a more specific exception class depending on your application needs.

---

## BaseConfig

An abstract config class providing generic logic for:

- Loading configuration from an array
- Validating required parameters
- Applying default values for optional parameters
- Casting values to the correct type

Child classes are required to define:

- `serviceName` — a string identifier for the service
- `requiredParams` — an array of required parameter names and types
- `optionalParams` — an array of optional parameters with type and default value

The `BaseConfig` constructor automatically assigns values to **typed, readonly properties** in the child class.

---

## StripeConfig

An example of a concrete config class for a hypothetical `Stripe` service.

- Declares the necessary **readonly properties**
- Specifies required and optional parameters
- Inherits validation and type casting logic from `BaseConfig`

```php
$stripeConfig = new StripeConfig([
    'api_key' => 'sk_test_123',
    'endpoint' => 'https://api.stripe.com',
]);
```
