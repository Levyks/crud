<?php

namespace Orchid\Crud\Screens;

use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;

class CreateScreen extends EditScreen
{

    /**
     * Query data.
     *
     * @param ResourceRequest $request
     *
     * @return array
     */
    public function query(ResourceRequest $request): array
    {
        $this->resource = $request->resource();
        $this->name = $this->resource::label();

        return [
            'model' => $request->model(),
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make($this->resource::saveButtonLabel())
                ->method('save')
                ->icon('check'),
        ];
    }


    /**
     * @param ResourceRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(ResourceRequest $request)
    {
        $model = $request->model();
        $model->forceFill($request->input('model'))->save()
            ? Toast::info('You have successfully saved the post.')
            : Toast::warning('An error has occurred');

        return redirect()->route('platform.resource.list', $request->resource);
    }
}