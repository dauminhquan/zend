<?php
/**
 * Created by PhpStorm.
 * User: quan
 * Date: 18/08/2017
 * Time: 20:09
 */

namespace Admin\Factory;


use Admin\Controller\ProductTableController;
use Admin\Model\BangSanpham;
use Admin\Model\BangNhomsanpham;
use Admin\Model\BangLoaisanpham;
use Admin\Model\ImageTable;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class ProductTableControllerFactory implements FactoryInterface
{


    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        return new ProductTableController(
            $container->get(BangSanpham::class),
            $container->get(BangNhomsanpham::class),
            $container->get(BangLoaisanpham::class),
            $container->get(ImageTable::class))
            ;

    }
}