<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Tjvendors
 * @author     Parth Lawate <contact@techjoomla.com>
 * @copyright  2016 Parth Lawate
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Vendor controller class.
 *
 * @since  1.6
 */
class TjvendorsControllerVendor extends JControllerForm
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->view_list = 'vendors';
		$this->input = JFactory::getApplication()->input;

		if (empty($this->client))
		{
			$this->client = $this->input->get('client', '');
		}

		parent::__construct();
	}

	/**
	 * Gets the URL arguments to append to an item redirect.
	 *
	 * @param   integer  $recordId  The primary key id for the item.
	 * @param   string   $urlVar    The name of the URL variable for the id.
	 *
	 * @return  string  The arguments to append to the redirect URL.
	 *
	 * @since   1.6
	 */
	protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id')
	{
		$append = parent::getRedirectToItemAppend($recordId);
		$append .= '&client=' . $this->client;

		return $append;
	}

	/**
	 * Gets the URL arguments to append to a list redirect.
	 *
	 * @return  string  The arguments to append to the redirect URL.
	 *
	 * @since   1.6
	 */
	protected function getRedirectToListAppend()
	{
		$append = parent::getRedirectToListAppend();
		$append .= '&client=' . $this->client;

		return $append;
	}

	/**
	 * Method for Save User specific commission
	 *
	 * @return void
	 */
	public function save()
	{
		$input  = JFactory::getApplication()->input;
		$client = $input->get('client', '', 'STRING');
		$data   = $input->get('jform', array(), 'array');
		$task   = $input->get('task', '', 'STRING');

		// Get client
		$client = $input->get('client', '', 'STRING');

		$model = $this->getModel('vendor');
		$save_option = $model->save_option($data, $client);

		if ($save_option)
		{
				$redirect = 'index.php?option=com_tjvendors&view=vendors&client=' . $client;
				$msg      = JText::_('COM_TJVENDORS_SUCCESSFULLY');
		}
		else
		{
			$redirect = 'index.php?option=com_tjvendors&view=vendors&client=' . $client;
			$msg      = JText::_('COM_TJVENDORS_ALREADY_EXISTED');
		}

		$this->setRedirect($redirect, $msg);
	}

	/**
	 * Method for Save User specific commission
	 *
	 * @return void
	 */
	public function apply()
	{
		$this->save();
	}

	/**
	 * Method for Save User specific commission
	 *
	 * @return void
	 */
	public function save2new()
	{
		$this->save();
	}
}
