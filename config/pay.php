<?php
return [
    //应用ID,您的APPID。
    'app_id' => "2016100100636199",

    //商户私钥
    'merchant_private_key' => "MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCAW3J+1ZtWgQaGiy9CJgh07tP2HdCvVq9+JRgOBPqXaVe0STJ7T8lDC0AC33wcdJ41Z79KKmxmAustON7WgtyOWQSTO+456dctRfljw6CwTIU/k9Xgp/PXTnWHpSqO6ngxUAMp2hq/0/wc5EZ23saITjenV6aCweTOz13l4dAc4SrygpUFbbIOP5ErK+G86Txk9YgxHZDmXT7j0x2ZlkudEC125sKHRWAYZ7Lx/daDgzZT0D6AjvDlwv9dhDtz6W+a90V8lVQfYss8iAQBM8ufF4OjWm2AcaXT/hxnKK/lJ6RA+7QMJCn+u7RmtsMuSCVAEYDA8351rbaaFc2lJJDRAgMBAAECggEARjI8xpKJNmCvseryeGmWXGS0dLfPheSRaxpcMmaUqTOKLGWPfxKeTdUcN7YDCQjZ8PkBC01yJMPZ28xrScMdXZffQaoX2YJCFFddUSsOePwQLznpUMhpOUmGSx2PzcL64nUQldXapSgIi8BnrOCekLK+Cv2LaZ0iRdvwTSUWjIPthq5x2CRVBYJAzrBR4/+auGFi8GtbOgPT0Wj9XrB2EAnQbZLF6dZl3jTqp6qqZNWvMGmmAmQ5I1DP+Bb4PNhjuRQScPh2y88u3DiJc1I6f1HDtBzZPw6i7aqfrhHpXtE57EgIbXU8Y5lh7LBzNdPa8G+/1JKZ0S3uLIyqxZHUAQKBgQC5h1pBB0pUUAWSGzNOkaQLL19AAkDP0UtyTzzj44sfIBpJJiHhLSKKkT+ufRAn7LsR9fra9vnIgaBdmXWWvs0zfWbz82X69+Pl5IPY5hzHg0UBFxj03A7S9v/s7CYEeeT0q19v5NuGnXeK5q8dXssYfv6jGA+x1gjsrvHnMjHPQQKBgQCxHMnbBT5r4SjJlB3MW6avMuLn9zgKOHCIjVL4w+T719K5qCL5Y9G9C7YXzyb3NkMz5rAjCCRJJL6apTOMEuG7foqD07ghvym8f8xNBSoLnmyG5DiE2X/qdAq5upU/gnhJRsjLro+aAoySFRgvBNuicqvETuHTPUFhwPMe5U/tkQKBgDFaml3WLKXFK9Y0Oi/aeoMnNPV4I/mkuadNAOu2qlm7VoLDDBw0v42RGhm210dnqFQc1YDOVqBKK3j6y9cwJrJd17dptmVO8GdFpPVcMae5ee/STydEKwVgA7DpGSvzqT6VICxJ+0QSO6zNtSPhBbIchmyoh/RM9c7QszVHmwyBAoGBAI8F+2+1xVmioqhdxs5vOKSESD4gIo4GU8HBtj4TG0fQWmf4gf24gPfTjEGf1AyQMiaoZJZ1ja/PT2hcfcrguI8LOdoIz8nYsGB7J0UPJYvqbCNmCsolRanT+ZFQPhPiTTaHRcFNfsNUyaVyCWx21NJTHahSNwS5k6HYCbxqW2gxAoGBAJ6uERPhvE9uM5pNoT/qH5UqqUYTeVZnNRpLOX3ATa2FEY3soP4oFL+7v+43EO3Rzg69Ag8N6ebaM8ZxwXaY1mppUbBvUOJlkmhsdnj3NNn8rLDdgTw+5Mszy6mbMbtkgvAhCmoFEyxBSioFe94S0zQpMC+oo32GcCaXZDT4twr8",

    //异步通知地址
    'notify_url' => "http://47.93.231.251/notify_url.php",

    //同步跳转
    'return_url' => "http://www.lar.com/returnpay",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwELOjcHJES2UxELr6q02LQvmuBuh0/4aJG61IPgGc0r5uSgfnx6yW+hE5WuLSFqpZOJK0JifoGsAJa/omYXVDy3i4qiauqnDm7q9H4bakxTbkYxdUeGv5Jpc/2eY0cHqDXkfURtrapnAScPIbLv6kU4wK1LdUjtYJW97lUu81DjkkE4F9+aB/PwdvwWz8x7o5lQ0PYk7+lvh2BsGNdSGHW4TGevoU3SZfKnvrwKurdt09OYqAEjDY8+rvUzw5VcAiY6M/sIu0AI6jK47j646diN8wM29fvrOzZI0nY22Jpsz+Be9zGLdAZGNsapuLekj+lyFlHgLV+uRBCmBfjpNXwIDAQAB",
];