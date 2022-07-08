<?php

namespace Samueletur\IpagLaravel\Facades;

use Illuminate\Support\Facades\Facade;

use Samueletur\IpagLaravel\QueryParams;
use Samueletur\IpagLaravel\Abstracts\Model;
use Samueletur\IpagLaravel\Http\Options;

/**
 * Facade for the Ipag
 *
 * @method static string generateId()
 * 
 * @method static QueryParams queryParams(array $params = [])
 * 
 * @method static Options httpOptions(array $options = [])
 * 
 * @method static \Samueletur\IpagLaravel\Models\IpagRegistration register(array $data)
 * 
 * @method static mixed authenticate()
 * 
 * @method static mixed listCustomers(array|QueryParams $queryParams = [], array|Options $options = [])
 * 
 * @method static mixed createCustomer(array|Model $data = [], array|Options $options = [])
 * 
 * @method static mixed editCustomer(int|string $id, array|Model $data = [], array|Options $options = [])
 * 
 * @method static mixed deleteCustomer(int|string $id, array|Options $options = [])
 * 
 * @method static mixed listPlans(array|QueryParams $queryParams = [], array|Options $options = [])
 * 
 * @method static mixed createPlan(array|Model $data = [], array|Options $options = [])
 * 
 * @method static mixed editPlan(int|string $id, array|Model $data = [], array|Options $options = [])
 * 
 * @method static mixed deletePlan(int|string $id, array|Options $options = [])
 * 
 * @method static mixed listCards(array|QueryParams $queryParams = [], array|Options $options = [])
 * 
 * @method static mixed createCard(array|Model $data = [], array|Options $options = [])
 * 
 * @method static mixed listCharges(array|QueryParams $queryParams = [], array|Options $options = [])
 * 
 * @method static mixed createCharge(array|Model $data = [], array|Options $options = [])
 * 
 * @method static mixed editCharge(int|string $id, array|Model $data = [], array|Options $options = [])
 * 
 * @method static mixed retryCharge(int|string $id)
 * 
 * @method static mixed reverseCharge(int|string $id)
 * 
 * @method static mixed cancelCharge(int|string $id)
 * 
 * @method static mixed listSubscriptions(array|QueryParams $queryParams = [], array|Options $options = [])
 * 
 * @method static mixed createSubscription(array|Model $data = [], array|Options $options = [])
 * 
 * @method static mixed createManualSubscription(array|Model $data = [], array|Options $options = [])
 * 
 * @method static mixed addTransactionSubscription(int|string $id, array|Model $data = [], array|Options $options = [])
 * 
 * @method static mixed editSubscription(int|string $id, array|Model $data = [], array|Options $options = [])
 * 
 * @method static mixed retryTransaction(int|string $id)
 * 
 * @method static mixed reverseTransaction(int|string $id)
 * 
 * @method static mixed cancelSubscription(int|string $id)
 * 
 * @method static mixed listTransactions(array|QueryParams $queryParams = [], array|Options $options = [])
 * 
 * @method static mixed editTransaction(int|string $id, array|Model $data = [], array|Options $options = [])
 * 
 * @method static mixed cancelTransaction(int|string $id)
 * 
 * @method static mixed getBoletoPDF(string $entityType, array $data, array|Options $options = [])
 * 
 * @method static mixed editWebhooks(int|string $id, array $data = [], array|Options $options = [])
 * 
 * @see \Samueletur\IpagLaravel\Ipag
 */
class Ipag extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ipag';
    }
}
